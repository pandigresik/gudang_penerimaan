<?php

namespace App\Models\Base;

use App\Models\Base as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Partner",
 *      required={"name"},
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
class Partner extends Model
{
    use HasFactory;
        use SoftDeletes;

    public $table = 'partners';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'name',
        'description',
        'active',
        'address',
        'city',
        'email',
        'phone',
        'mobile',
        'additional_info'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
        'active' => 'boolean',
        'address' => 'string',
        'city' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'mobile' => 'string',
        'additional_info' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'nullable|string|max:10',
        'name' => 'required|string|max:50',
        'description' => 'nullable|string',
        'active' => 'nullable|boolean',
        'address' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'email' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'mobile' => 'nullable|string|max:255',
        'additional_info' => 'nullable|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function goodReceipts()
    {
        return $this->hasMany(\App\Models\Base\GoodReceipt::class, 'partner_id');
    }
}
