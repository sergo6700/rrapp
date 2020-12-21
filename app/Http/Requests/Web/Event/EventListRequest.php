<?php

namespace App\Http\Requests\Web\Event;

use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EventListRequest
 *
 * @package App\Http\Requests\Web\Event
 */
class EventListRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
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
			'year' => 'integer',
			'month' => "integer|min:{$rules->month_min}|max:{$rules->month_max}",
			'past' => 'boolean',
		];
	}
}
