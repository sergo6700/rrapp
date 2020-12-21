<?php

namespace App\Http\Requests\Admin\PageMetadata;

use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PageMetadataRequest
 * @package App\Http\Requests\Admin\PageMetadata
 */
class PageMetadataRequest extends FormRequest
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
            'page_alias' => "required",
            'title' => "required|min:{$rules->string_min}|max:{$rules->string_max}",
            'description' => "max:{$rules->max_length_description}",
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
            'title.required' => 'Поле Название (title) обязательно для заполнения',
            'title.min' => 'Поле Название (title) должно быть больше :min',
            'title.max' => 'Поле Название (title) слишком длинное (максимальное количество символов равно :max)',
            'description.max' => 'Поле описание (description) страницы слишком длинное (максимальное количество символов равно :max)',
        ];
    }
}
