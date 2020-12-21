<?php

namespace App\Http\Requests\Web\Service;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ServicesListRequest
 *
 * @package App\Http\Requests\Web\Service
 */
class ServicesListRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'tags' => 'array',
			'tags.*' => 'string|exists:tags,name'
		];
	}

}
