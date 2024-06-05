<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse\GoodReceipt;
use App\Models\Warehouse\GoodReceiptItemClassification;
use App\Models\Warehouse\GoodReceiptItemWeight;
use Exception;

/**
 * Class GoodReceiptItemSampleClassificationRepository
 * @package App\Repositories\Warehouse
 * @version May 13, 2024, 7:45 am WIB
 */

class GoodReceiptItemSampleClassificationRepository extends GoodReceiptItemClassificationRepository
{
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
            $goodReceiptItemWeight = $input['good_receipt_item_weight_id'];
            $goodReceiptItemWeightObj = GoodReceiptItemWeight::find($goodReceiptItemWeight);
            $input['good_receipt_item_id'] = $goodReceiptItemWeightObj->good_receipt_item_id;
            $input['reference'] = $goodReceiptItemWeightObj->id;
            
            $this->saveItems($input);
            $totalWeightItem = GoodReceiptItemClassification::where(['good_receipt_item_id' => $goodReceiptItemWeightObj->good_receipt_item_id, 'reference' => $goodReceiptItemWeightObj->id])->sum('weight');
            // update status good_receipt_item_weight menjadi done, jika total yang ditimbang = total sample
            if ($totalWeightItem >= $goodReceiptItemWeightObj->weight){
                $goodReceiptItemWeightObj->update(['state' => 'done']);
            }            
            // clear cache untuk good receipt
            (new GoodReceipt)->flushCache();
            $connection->commit();
            return $this->model;
        } catch (Exception $e) {
            $connection->rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
