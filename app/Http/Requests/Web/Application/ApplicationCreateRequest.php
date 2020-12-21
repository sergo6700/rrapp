<?php


namespace App\Http\Requests\Web\Application;

use App\Rules\ValidRecaptcha;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;


/**
 * Class ApplicationCreateRequest
 * @package App\Http\Requests\Web\Application
 */
class ApplicationCreateRequest extends FormRequest
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
        	'full_name' => "required|string|min:{$rules->string_min}|max:{$rules->string_max}",
			'email' => "required|string|email|max:{$rules->email_max}",
			'kind_of_activity' => "required|string|min:{$rules->string_min}|max:{$rules->string_max}",
			'content' => 'required|string',
			'personalData' => 'required',
			'siteRules' => 'required',
            'g-recaptcha-response' => ['required', new ValidRecaptcha]
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
            'full_name.max' => 'Поле ФИО слишком длинное (максимальное количество символов равно :max)',
            'email.max' => 'Поле E-mail слишком длинное (максимальное количество символов равно :max)',
            'kind_of_activity.max' => 'Поле Вид деятельности слишком длинное (максимальное количество символов равно :max)',
        ];
    }
}
