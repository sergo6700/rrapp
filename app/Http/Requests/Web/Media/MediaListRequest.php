<?php

namespace App\Http\Requests\Web\Media;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MediaListRequest
 * @package App\Http\Requests\Web\Media
 */
class MediaListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() :bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() :array
    {
        return [
            //
        ];
    }
}
