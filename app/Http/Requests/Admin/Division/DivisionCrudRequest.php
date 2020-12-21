<?php

namespace App\Http\Requests\Admin\Division;

use App\Support\Validation\ValidationRules;
use Backpack\CRUD\app\Http\Requests\CrudRequest;

/**
 * Class DivisionCrudRequest
 * @package App\Http\Requests\Admin\Division
 */
class DivisionCrudRequest extends CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = new ValidationRules();

        return [
            'name' => "required|min:{$rules->string_min}|max:{$rules->string_max}",
            'content' => "required|min:{$rules->string_min}",
            'position' => "integer|min:{$rules->position_min}|max:{$rules->position_max}"
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
			'name.required' => 'Поле Заголовок обязательно для заполнения',
            'name.max' => 'Поле Заголовок слишком длинное (максимальное количество символов равно :max)',
            'position.min' => 'Поле должно быть больше или равно :min',
            'position.max' => 'Поле должно быть меньше или равно :max',
            'position.integer' => 'Поле должно быть валидным положительным числом',
        ];
    }
}
