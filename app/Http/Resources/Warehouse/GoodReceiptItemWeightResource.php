<?php

namespace App\Http\Resources\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodReceiptItemWeightResource extends JsonResource
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
            'good_receipt_item_id' => $this->good_receipt_item_id,
            'quantity' => $this->quantity,
            'weight' => $this->weight,
            'is_sampling' => $this->is_sampling,
            'state' => $this->state
        ];
    }
}
