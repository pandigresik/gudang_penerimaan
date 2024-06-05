<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'active' => $this->active,
            'address' => $this->address,
            'city' => $this->city,
            'email' => $this->email,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'additional_info' => $this->additional_info
        ];
    }
}
