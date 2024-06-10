<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse\GoodReceiptItem;
use App\Models\Warehouse\GoodReceiptItemClassification;
use App\Models\Warehouse\GoodReceiptItemWeight;
use App\Repositories\BaseRepository;
use Exception;

/**
 * Class GoodReceiptItemClassificationRepository
 * @package App\Repositories\Warehouse
 * @version May 13, 2024, 7:45 am WIB
*/

class GoodReceiptItemClassificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'good_receipt_item_id',
        'product_id',
        'weight'
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
        return GoodReceiptItemClassification::class;
    }
    
    protected function saveItems($input)
    {        
        try {            
            $goodReceiptItem = $input['good_receipt_item_id'];
            $reference = $input['reference'] ?? null;
            $items = $input['items'];
            
            foreach ($items as $item) {
                $item['good_receipt_item_id'] = $goodReceiptItem;
                $item['reference'] = $reference;                
                $this->model->create($item);                
            }            
            return $this->model;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }        
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
            $this->saveItems($input);
            $goodReceiptItem = GoodReceiptItem::with(['goodReceiptItemWeightsNonSample','goodReceiptItemNonSampleClassifications'])->find($input['good_receipt_item_id']);
            // update status good receipt item menjadi done jika total penimbangan klasifikasi = total penimbangan awal            
            $totalWeightItem = $goodReceiptItem->goodReceiptItemWeightsNonSample->sum('weight');            
            $sudahTimbang = $goodReceiptItem->goodReceiptItemNonSampleClassifications->sum('weight');            
            if ($sudahTimbang >= $totalWeightItem){
                $goodReceiptItem->goodReceiptItemWeightsNonSample()->update(['state' => 'done']);                
            }
            // clear cache untuk good receipt
            (new GoodReceiptItem)->flushCache();
            (new GoodReceiptItemWeight)->flushCache();
            $connection->commit();
            return $this->model;
        } catch (Exception $e) {
            $connection->rollBack();
            throw new Exception($e->getMessage());
        }        
    }
}
