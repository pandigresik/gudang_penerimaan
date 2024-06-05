<?php

namespace App\Http\Requests\API\Warehouse;

use App\Models\Warehouse\GoodReceipt;
use InfyOm\Generator\Request\APIRequest;

class UpdateGoodReceiptAPIRequest extends APIRequest
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
        $rules = GoodReceipt::$rules;
        
        return $rules;
    }
}
