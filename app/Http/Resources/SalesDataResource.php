<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            array_merge(
            parent::toArray($request),
            [
                'customer' => [
                    'id' => $this->customer_id,
                    'first_name' => $this->customer_first_name,
                    'last_name' => $this->customer_last_name,
                ],
            ]
        );
    }
}
