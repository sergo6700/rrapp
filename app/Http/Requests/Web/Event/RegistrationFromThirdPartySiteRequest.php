<?php

namespace App\Http\Requests\Web\Event;

use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegistrationFromThirdPartySiteRequest
 * @package App\Http\Requests\Web\Event
 */
class RegistrationFromThirdPartySiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
            'name' => ['required', 'string', "min:{$rules->name_min}", "max:{$rules->name_max}"],
            'event_id' => ['required', 'integer', 'min:1'],
            'email' => ['required', 'string', 'email', "max:{$rules->email_max}", 'unique:users'],
			'phone' => ['nullable', "regex:{$rules->pattern_phone}"],
			'tin' => ['required', 'integer', "regex:{$rules->pattern_tin}"],
			'personalData' => 'required',
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
            'name.max' => 'Поле Имя слишком длинное (максимальное количество символов равно :max)',
            'email.max' => 'Поле E-mail слишком длинное (максимальное количество символов равно :max)',
            'tin.regex' => 'Поле ИНН должно представлять собой последовательность из 10 или 12 цифр',
            'tin.integer' => 'Поле ИНН должно представлять собой последовательность из 10 или 12 цифр',
        ];
    }
}
