<?php

namespace App\Http\Requests\Web\Application;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegistrationToEventCreateRequest
 * @package App\Http\Requests\Web\Application
 */
class RegistrationToEventCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_id' => 'required', 'exists:events,id',
        ];
    }
}
