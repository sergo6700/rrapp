<?php

namespace App\Http\Requests\Api\Microcredit;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MicrocreditCalculate
 *
 * @package App\Http\Requests\Api\Microcredit
 */
class GetMicrocreditProducts extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'okveds'    => 'sometimes|array',
            'okveds.*'  => 'string',
            'antiseptic'=> 'sometimes|boolean',
            'social'    => 'sometimes|boolean',
            'support'   => 'sometimes|boolean',
            'gov-program'=> 'sometimes|boolean',
            'sex'       => 'sometimes|integer',
            'monogorod' => 'sometimes|integer',
            'reg-date'  => 'sometimes|integer',
            'birth-date'=> 'sometimes|date_format:Y-m-d',
            'pledge'    => 'sometimes|boolean',
            'surety'    => 'sometimes|boolean',
            'part-pledge'=> 'sometimes|boolean',
            'loan'      => 'sometimes|boolean',
        ];
    }
}
