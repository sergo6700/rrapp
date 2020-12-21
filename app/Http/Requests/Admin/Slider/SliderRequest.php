<?php

namespace App\Http\Requests\Admin\Slider;

use App\Rules\ImageExistence;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SliderRequest
 * @package App\Http\Requests\Admin\Slider
 */
class SliderRequest extends FormRequest
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
            'name' => "required|min:{$rules->string_min}|max:{$rules->string_max}",
            'sort' => "integer|min:{$rules->position_min}|max:{$rules->position_max}",
            'link' => "required|min:{$rules->string_min}|url",
            'image_desktop' => ['required', "regex:{$rules->pattern_image}", new ImageExistence(request()->all())],
            'image_mobile' => ['required', "regex:{$rules->pattern_image}", new ImageExistence(request()->all())],
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
			'name.required' => 'Поле Название обязательно для заполнения',
			'name.min' => 'Поле Название должно быть больше :min',
			'name.max' => 'Поле Название слишком длинное (максимальное количество символов равно :max)',
            'link.required' => 'Поле Ссылка обязательно для заполнения',
            'link.min' => 'Поле Ссылка должно быть больше :min',
            'link.url' => 'Поле Ссылка должно быть валидной ссылкой',
            'image_desktop.required' => 'Поле Изображение обязательно для заполнения',
            'image_mobile.required' => 'Поле Изображение обязательно для заполнения',
            'sort.min' => 'Поле должно быть больше или равно 0',
            'sort.max' => 'Поле должно быть меньше или равно :max',
            'sort.integer' => 'Поле должно быть валидным положительным числом',
		];
	}
}
