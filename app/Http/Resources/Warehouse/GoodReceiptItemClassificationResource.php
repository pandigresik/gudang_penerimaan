<?php

namespace App\Http\Resources\Warehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodReceiptItemClassificationResource extends JsonResource
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
            'product_id' => $this->product_id,
            'weight' => $this->weight
        ];
    }
}
