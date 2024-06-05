<?php

namespace App\Models\Warehouse;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="GoodReceiptItem",
 *      required={"good_receipt_id", "product_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="internal code from company, maybe existing code in other application",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="city",
 *          description="city",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="mobile",
 *          description="mobile",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="additional_info",
 *          description="additional_info",
 *          type="string"
 *      )
 * )
 */
class GoodReceiptItem extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'good_receipt_items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'good_receipt_id',
        'product_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'good_receipt_id' => 'integer',
        'product_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'good_receipt_id' => 'required',
        'product_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function goodReceipt()
    {
        return $this->belongsTo(\App\Models\Warehouse\GoodReceipt::class, 'good_receipt_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Base\Product::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function goodReceiptItemClassifications()
    {
        return $this->hasMany(\App\Models\Warehouse\GoodReceiptItemClassification::class, 'good_receipt_item_id');
    }

    public function goodReceiptItemSampleClassifications()
    {
        return $this->goodReceiptItemClassifications()->whereNotNull('reference');
    }

    public function goodReceiptItemNonSampleClassifications()
    {
        return $this->goodReceiptItemClassifications()->whereNull('reference');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function goodReceiptItemWeights()
    {
        return $this->hasMany(\App\Models\Warehouse\GoodReceiptItemWeight::class, 'good_receipt_item_id');
    }

    public function goodReceiptItemWeightsNonSample()
    {
        return $this->hasMany(\App\Models\Warehouse\GoodReceiptItemWeight::class, 'good_receipt_item_id')->where('is_sampling', false);
    }
}
