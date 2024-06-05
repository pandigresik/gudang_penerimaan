<?php

namespace App\Http\Requests\API\Warehouse;

use App\Models\Warehouse\GoodReceiptItemWeight;
use InfyOm\Generator\Request\APIRequest;

class UpdateGoodReceiptItemWeightAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = GoodReceiptItemWeight::$rules;
        
        return $rules;
    }
}
