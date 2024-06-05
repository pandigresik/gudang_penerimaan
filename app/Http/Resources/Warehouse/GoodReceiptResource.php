<?php

namespace App\Http\Resources\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodReceiptResource extends JsonResource
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
            'id' => $this->id,
            'partner_id' => $this->partner_id,
            'receipt_date' => $this->receipt_date,
            'state' => $this->state,
            'description' => $this->description
        ];
    }
}
