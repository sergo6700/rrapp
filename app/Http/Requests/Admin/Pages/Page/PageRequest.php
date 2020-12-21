<?php

namespace App\Http\Requests\Admin\Pages\Page;

use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PageCreateRequest
 * @package App\Http\Requests\Pages
 */
class PageRequest extends FormRequest
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
        $id = \Request::get('id');
        $rules = new ValidationRules();

        return [
            'title' => "required|min:{$rules->string_min}|max:{$rules->string_max}",
            'slug' => 'unique:pages,slug'.($id ? ','.$id : ''),
            'description' => "max:{$rules->string_max}",
            'content' => "required|min:{$rules->string_min}",

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
			'content.required' => 'Поле Содержимое страницы обязательно для заполнения',
            'title.min' => 'Поле Заголовок страницы должно быть больше :min',
            'title.max' => 'Поле Заголовок страницы слишком длинное (максимальное количество символов равно :max)',
            'description.max' => 'Поле Мета описание страницы слишком длинное (максимальное количество символов равно :max)',
		];
	}
}
