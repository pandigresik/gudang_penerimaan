<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Warehouse\GoodReceiptItemClassification;

class CreateGoodReceiptItemClassificationRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $permissionName = 'good_receipt_item_classifications-create';
        return Auth::user()->can($permissionName);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = GoodReceiptItemClassification::$rules;
        unset($rules['product_id']);
        unset($rules['good_receipt_item_id']);
        unset($rules['weight']);
        return $rules;
    }

    /**
     * Get all of the input based value from property fillable  in model and files for the request.
     *
     * @param null|array|mixed $keys
     *
     * @return array
    */
    public function all($keys = null){
        $keys = (new GoodReceiptItemClassification)->fillable;
        $keys = array_merge($keys, ['good_receipt_item_weight_id', 'items']);
        return parent::all($keys);
    }
}
