<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse\GoodReceiptItem;
use App\Repositories\BaseRepository;

/**
 * Class GoodReceiptItemRepository
 * @package App\Repositories\Warehouse
 * @version May 13, 2024, 7:45 am WIB
*/

class GoodReceiptItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'good_receipt_id',
        'product_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return GoodReceiptItem::class;
    }    
}
