<?php


namespace App\Http\Requests\Web\Application;

use App\Models\Acl\User;
use App\Rules\ValidationTinOrRole;
use App\Rules\ValidRecaptcha;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;


/**
 * Class RegisterProfileUpdateRequest
 * @package App\Http\Requests\Web\Application
 */
class RegisterProfileUpdateRequest extends FormRequest
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
        $user_roles_in_company = Arr::pluck(config('handbook.user_roles'), 'id');
        $rules = new ValidationRules();

        return [
            'email' => 'required|string|email',
            'legal_address' => ['nullable', 'string'],
            'kpp' => ['nullable', 'digits:' . User::KPP_LENGTH],
            'ogrn' => ['nullable', "regex:{$rules->pattern_ogrn}"],
            'role_in_company_id' => [
                'required',
                Rule::in($user_roles_in_company)
            ],
            'tin' => ['required', 'string', new ValidationTinOrRole($this->request->all())],
			'personalData' => 'required',
			'siteRules' => 'required',
            'g-recaptcha-response' => ['required', new ValidRecaptcha]
        ];
    }
}
