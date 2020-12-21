<?php

namespace App\Http\Requests\Web\Profile;

use App\Rules\ValidationTinOrRole;
use App\Support\Validation\ValidationRules;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

/**
 * Class ProfileUpdateRequest
 * @package App\Http\Requests\Web\Profile
 */
class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = new ValidationRules();

        return [
            'name' =>   "required|string|min:{$rules->name_min}|max:{$rules->name_max}",
            'email' =>  ["required", 'string', 'email', "max:{$rules->email_max}", Rule::unique('users')->ignore($this->user()->id)],
			'role_in_company_id' => ['required_with:company_name', Rule::in(Arr::pluck(config('handbook.user_roles'), 'id'))],
            'tin' =>    ['required', 'string', new ValidationTinOrRole($this->request->all())],
            'phone' =>  ['nullable', "regex:{$rules->pattern_phone}"],
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
            'name.required' => 'Поле ФИО обязательно для заполнения',
            'name.min' => 'Поле ФИО должно быть больше :min символов',
            'name.max' => 'Поле ФИО слишком длинное (максимальное количество символов равно :max)',
            'email.max' => 'Поле E-mail слишком длинное (максимальное количество символов равно :max)',
            'regex' => 'Некорректный формат Телефона'
        ];
    }
}
