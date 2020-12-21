<?php

namespace App\Http\Requests\Admin\Post;

use App\Rules\ImageExistence;
use App\Support\Validation\ValidationRules;
use Backpack\CRUD\app\Http\Requests\CrudRequest;

/**
 * Class ArticleVideoCrudRequest
 * @package App\Http\Requests
 */
class ArticleVideoCrudRequest extends CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
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
            'title' => "required|min:{$rules->string_min}|max:{$rules->string_max}",
            'slug' => 'unique:articles,slug,'.\Request::get('id'),
			'date' => 'required|date',
			'content' => "required|min:{$rules->string_min}|",
            'image' => ['required', "regex:{$rules->pattern_image}", new ImageExistence(request()->all())],
            'visibility_type_id' => 'required|integer|min:1|max:3',
            'view_id' => 'required|integer|min:1|max:4',
            'fixed' => 'boolean'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
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
			'content.required' => 'Поле Ссылка на видео обязательно для заполнения',
			'date.required' => 'Поле Дата публикации страницы обязательно для заполнения',
            'image.required' => 'Поле Обложка обязательно для заполнения',
            'regex' => 'Некорректный формат файла. Разрешенные форматы: jpg / jpeg / png / jpe / bmp / svg / webp / gif'
        ];
    }
}
