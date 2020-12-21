<?php

namespace App\Http\Requests\Web\Auth;

use App\Models\Acl\User;
use App\Rules\ValidationTinOrRole;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

/**
 * Class RegisterStep2ProfileUpdateRequest
 * @package App\Http\Requests\Web\Auth
 */
class RegisterStep2ProfileUpdateRequest extends FormRequest
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
        $user_roles_in_company = Arr::pluck(config('handbook.user_roles'), 'id');
        $rules = new ValidationRules();

        return [
            'email' => ['required', 'string', 'email', "max:{$rules->email_max}", 'unique:users'],
            'legal_address' => ['nullable', 'string'],
            'kpp' => ['nullable', 'digits:' . User::KPP_LENGTH],
            'ogrn' => ['nullable', "regex:{$rules->pattern_ogrn}"],
            'role_in_company_id' => [
                'required',
                Rule::in($user_roles_in_company)
            ],
            'tin' => ['required', 'string', new ValidationTinOrRole($this->request->all())],
            'company_name' => ['nullable', 'string', "max:{$rules->string_max}"],
            'personalData' => 'required',
            'siteRules' => 'required',
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
            'email.unique' => 'Поле E-mail с таким значением уже существует',
            'email.max' => 'Поле E-mail слишком длинное (максимальное количество символов равно :max)',
        ];
    }
}