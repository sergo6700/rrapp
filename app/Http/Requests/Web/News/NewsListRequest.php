<?php

namespace App\Http\Requests\Web\News;

use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsListRequest
 *
 * @package App\Http\Requests\Web\News
 */
class NewsListRequest extends FormRequest
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
        $rules = new ValidationRules();

		return [
			'year' => 'integer|nullable',
			'month' => "integer|nullable|min:{$rules->month_min}|max:{$rules->month_max}",
		];
	}

}
