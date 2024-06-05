<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse\GoodReceipt;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodReceiptRepository
 * @package App\Repositories\Warehouse
 * @version May 13, 2024, 7:45 am WIB
*/

class GoodReceiptRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'partner_id',
        'receipt_date',
        'state',
        'description'
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
        return GoodReceipt::class;
    }

    /**
     * Create model record.
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        $connection = $this->model->getConnection();
        $connection->beginTransaction();
        try {
            $model = parent::create($input);
            $productId = $input['product_id'];
            $items = $input['items'];
            
            foreach ($productId as $product) {
                $grItem = $model->goodReceiptItems()->create(['product_id' => $product]);
                $itemProduct = $items[$product];                
                foreach ($itemProduct as $key => $itemWeight) {                                    
                    $grItem->goodReceiptItemWeights()->create($itemWeight);
                }            
            }
            $connection->commit();
            return $model;
        } catch (Exception $e) {
            $connection->rollBack();
            throw new Exception($e->getMessage());
        }

        
    }
}
