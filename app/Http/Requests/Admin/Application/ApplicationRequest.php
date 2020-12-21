<?php

namespace App\Http\Requests\Admin\Application;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ApplicationRequest
 * @package App\Http\Requests\Admin\Application
 */
class ApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
        ];
    }

}
