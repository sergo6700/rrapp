<?php

namespace App\Http\Requests\Admin\Media;

use App\Http\Requests\Request;
use App\Rules\ImageExistence;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MediaRequest
 * @package App\Http\Requests\Admin\Media
 */
class MediaRequest extends FormRequest
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
            'description' => "required|string|min:{$rules->string_min}",
            'image' => [
                'required',
                "regex:{$rules->pattern_image}",
                new ImageExistence(request()->all())
            ],
            'link' => 'required|url',
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
            'description.min' => 'Поле Описание должно быть больше :min',
            'description.required' => 'Поле Описание обязательно для заполнения',
            'image.required' => 'Поле Картинка обязательно для заполнения',
            'regex' => 'Некорректный формат файла. 
                        Разрешенные форматы: jpg / jpeg / png / jpe / bmp / svg / webp / gif',
            'link.required' => 'Поле Ссылка (URL) обязательно для заполнения',
            'link.url' => 'Поле Ссылка (URL) должно быть действительным URL',
        ];
    }
}
