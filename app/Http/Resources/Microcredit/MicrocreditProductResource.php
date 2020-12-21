<?php

namespace App\Http\Resources\Microcredit;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class MicrocreditProductResource
 *
 * @package App\Http\Resources\Microcredit
 */
class MicrocreditProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->resource['id'],
            'name'          => $this->resource['name'],
            'description'   => $this->resource['description'],
            'min_loan'      => $this->resource['min_loan'],
            'max_loan'      => $this->resource['max_loan'],
            'loan_terms'    => $this->resource['loan_terms'],
        ];
    }
}
