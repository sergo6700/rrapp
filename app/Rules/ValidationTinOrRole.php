<?php

namespace App\Rules;

use App\Support\Validation\ValidationRules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

/**
 * Class ValidationTinOrRole
 *
 * @package App\Rules
 */
class ValidationTinOrRole implements Rule
{
    /**
     * Data array
     *
     * @var array
     */
    public $data;

    /**
     * ValidationRules object
     *
     * @var ValidationRules
     */
    public $validationRules;

    /**
     * Flag defining what is the other role
     *
     * @var boolean
     */
    public $isOtherRole;

    /**
     * Flag indicating that the data is too long
     *
     * @var boolean
     */
    public $dataTooLong;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->validationRules = new ValidationRules();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user_roles_in_company = Arr::pluck(config('handbook.user_roles'), 'id');
        $other_id = $user_roles_in_company[2];

        if ($other_id == $this->data['role_in_company_id']) {
            $this->isOtherRole = true;

            if (mb_strlen($value) > $this->validationRules->tin_max) {
                $this->dataTooLong = true;
                return false;
            }

            if ($value) {
                return preg_match($this->validationRules->pattern_tin, $value);
            } else {
                return true;
            }
        } else {
            return preg_match($this->validationRules->pattern_tin, $value);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->isOtherRole && $this->dataTooLong) {
            return "Поле Роль слишком длинное (максимальное количество символов равно {$this->validationRules->tin_max})";
        }

        if ($this->isOtherRole) {
            return 'Поле Роль должно быть заполнено';
        }

        return 'Введите корректный ИНН';
    }
}
