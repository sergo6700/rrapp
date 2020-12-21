<?php

namespace App\Http\Requests\Admin\Email;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmailTemplateCrudRequest
 * @package App\Http\Requests\Admin\Email
 */
class EmailTemplateCrudRequest extends FormRequest
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
        return [
        	'name' => 'required'
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
		];
	}
}
