<?php

namespace App\Models\Warehouse;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="GoodReceiptItemWeight",
 *      required={"good_receipt_item_id", "quantity", "weight", "is_sampling", "state"},
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
class GoodReceiptItemWeight extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'good_receipt_item_weights';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'good_receipt_item_id',
        'quantity',
        'weight',
        'is_sampling',
        'state'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'good_receipt_item_id' => 'integer',
        'quantity' => 'integer',
        'weight' => 'decimal:1',
        'is_sampling' => 'boolean',
        'state' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'good_receipt_item_id' => 'required',
        'quantity' => 'required',
        'weight' => 'required|numeric',
        'is_sampling' => 'required|boolean',
        'state' => 'required|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function goodReceiptItem()
    {
        return $this->belongsTo(\App\Models\Warehouse\GoodReceiptItem::class, 'good_receipt_item_id');
    }    
}
