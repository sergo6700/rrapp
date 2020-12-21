<?php

namespace App\Http\Requests\Admin\Service;

use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ApplicationRequest
 * @package App\Http\Requests\Admin\Service
 */
class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
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
            'title' => "required|min:{$rules->string_min}|max:{$rules->string_max}",
            'description' => "max:{$rules->string_max}",
            'division_id' => 'required|exists:divisions,id',
            'emails' => 'required',
            'tags' => 'required',
            'short_content' => "required|min:{$rules->string_min}",
            'full_content' => "required|min:{$rules->string_min}",
            'position' => "integer|min:{$rules->position_min}|max:{$rules->position_max}"
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
			'title.required' => 'Поле Название обязательно для заполнения',
			'title.min' => 'Поле Название должно быть больше :min',
			'title.max' => 'Поле Название слишком длинное (максимальное количество символов равно :max)',
            'description.max' => 'Поле Мета описание страницы слишком длинное (максимальное количество символов равно :max)',
			'division_id.required' => 'Поле Организатор обязательно для заполнения',
			'tags.required' => 'Поле Теги обязательно для заполнения',
			'emails.required' => 'Поле E-mail обязательно для заполнения',
			'short_content.required' => 'Поле Краткое описание обязательно для заполнения',
			'full_content.required' => 'Поле Полное описание обязательно для заполнения',
			'position.min' => 'Поле должно быть больше или равно 0',
            'position.max' => 'Поле должно быть меньше или равно :max',
            'position.integer' => 'Поле должно быть валидным положительным числом',
		];
	}
}
