<?php

namespace App\Http\Requests\Admin\Event;

use App\Rules\FileExistence;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EventRequest
 */
class EventRequest extends FormRequest
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
            'slug' => 'sometimes|nullable|unique:events,slug,'.\Request::get('id'),
            'description' => "max:{$rules->string_max}",
            'date_from' => 'required|string|date_format:Y-m-d H:i:s',
            'division_id' => 'required|exists:divisions,id',
            'visitors_count' => "integer|min:{$rules->visitors_count_min}",
            'visited_count' => "integer|min:{$rules->visited_count_min}",
            'short_content' => "required|min:{$rules->string_min}",
            'full_content' => "required|min:{$rules->string_min}",
            'address_hidden' => 'required',
            'report' => ['nullable', "regex:{$rules->pattern_file}", new FileExistence(request()->all())],
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
            'description.max' => 'Поле Мета описание страницы слишком длинное (максимальное количество символов равно :max)',
            'date_from.required' => 'Поле Дата и время начала обязательно для заполнения',
			'division_id.required' => 'Поле Организатор обязательно для заполнения',
			'address_hidden.required' => 'Поле Место проведения обязательно для заполнения',
			'short_content.required' => 'Поле Краткое описание обязательно для заполнения',
			'full_content.required' => 'Поле Полное описание обязательно для заполнения',
			'visitors_count.min' => 'Поле Максимальное количество участников должно быть больше или равно :min',
			'visitors_count.integer' => 'Поле Максимальное количество участников должно быть числовым значением',
			'visited_count.min' => 'Поле Пришло участников должно быть больше или равно :min',
			'visited_count.integer' => 'Поле Пришло участников должно быть числовым значением',
            'regex' => 'Некорректный формат файла. Разрешенные форматы: pdf / doc / docx / xls / xlsx'
        ];
    }
}
