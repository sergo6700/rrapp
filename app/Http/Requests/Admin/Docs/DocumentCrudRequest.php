<?php

namespace App\Http\Requests\Admin\Docs;

use App\Rules\FileExistence;
use App\Support\Validation\ValidationRules;
use Backpack\CRUD\app\Http\Requests\CrudRequest;

/**
 * Class ArticleCrudRequest
 * @package App\Http\Requests
 */
class DocumentCrudRequest extends CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => "required|string|min:{$rules->string_min}|max:{$rules->string_max}",
            'description' => "nullable|max:{$rules->string_max}",
            'content' => "required|string|min:{$rules->string_min}",
			'attached_files.*' => ["regex:{$rules->pattern_file}", new FileExistence(request()->all())],
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
			'name.required' => 'Поле Название обязательно для заполнения',
            'name.min' => 'Поле Название должно быть больше :min',
            'name.max' => 'Поле Название слишком длинное (максимальное количество символов равно :max)',
            'description.max' => 'Поле Мета описание страницы слишком длинное (максимальное количество символов равно :max)',
            'regex' => 'Некорректный формат файла. Разрешенные форматы: pdf / doc / docx / xls / xlsx'
		];
	}
}
