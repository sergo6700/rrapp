<?php

namespace App\Http\Requests\Web\Service;

use App\Services\Web\CaptchaService;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ServiceSendFeedbackRequest
 *
 * @package App\Http\Requests\Web\Service
 */
class ServiceSendFeedbackRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'content' => 'required|string',
			'g-recaptcha-response' => 'required|string',
		];
	}

	/**
	 * Configure the validator instance.
	 *
	 * @param  \Illuminate\Validation\Validator  $validator
	 * @return void
	 */
	public function withValidator($validator): void
	{
		$validator->after(function ($validator) {
			$captcha_service = new CaptchaService();

			if ($this->has('g-recaptcha-response') && !$captcha_service->verify($this->get('g-recaptcha-response'))) {
				$validator->errors()->add('g-recaptcha-response', __('validation.custom.captcha_error'));
			}
		});
	}

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'content.required' => 'Поле Текст сообщения обязательно для заполнения',
        ];
    }
}
