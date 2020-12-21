<?php

namespace App\Http\Requests\Admin\Pages\PageTemplate;

use App\Models\Pages\PageTemplate;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PageCreateRequest
 * @package App\Http\Requests\Pages
 */
class PageTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();//true;//\Auth::check();
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
            'name'          => "required|min:3|max:{$rules->string_max}",
            'template'      => 'required',
            'class_name'    => "required|min:{$rules->class_name_min}|max:{$rules->class_name_max}",
            'styles'        => 'sometimes|nullable',
        ];
    }

    /**
     * After validation (Extended)
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled('class_name')) {
                if (!PageTemplate::validateClassName($this->get('class_name'))) {
                    $validator->errors()->add('class_name', "Формат CSS класса не соответсвует стандарту наименований.\nВведите буквы, цифры, дефис или подчеркивание без пробелов.\nНазвание может начинаться с точки. \nПример правильного заполнения \".my-class-name\", \"my_classname\", \"my_class-name-2\"");
                }
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
			'name.required' => 'Поле Название обязательно для заполнения',
            'name.min' => 'Поле Название должно быть больше :min',
            'name.max' => 'Поле Название слишком длинное (максимальное количество символов равно :max)',
		];
	}
}
