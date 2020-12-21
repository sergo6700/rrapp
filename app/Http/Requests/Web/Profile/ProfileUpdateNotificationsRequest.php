<?php

namespace App\Http\Requests\Web\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

/**
 * Class ProfileUpdateNotificationsRequest
 *
 * @package App\Http\Requests\Web\Profile
 */
class ProfileUpdateNotificationsRequest extends FormRequest
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
			'notifications' => 'array',
			'notifications.*.type_id' => ['required', Rule::in(Arr::pluck(config('handbook.notification_types'), 'id')),],
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
            'notifications.required' => 'Поле Уведомление обязательно для заполнения',
        ];
    }

}
