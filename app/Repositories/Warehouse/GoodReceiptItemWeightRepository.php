<?php

namespace App\Repositories\Warehouse;

use App\Models\Warehouse\GoodReceiptItemWeight;
use App\Repositories\BaseRepository;

/**
 * Class GoodReceiptItemWeightRepository
 * @package App\Repositories\Warehouse
 * @version May 13, 2024, 7:45 am WIB
*/

class GoodReceiptItemWeightRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'good_receipt_item_id',
        'quantity',
        'weight',
        'is_sampling',
        'state'
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
        return GoodReceiptItemWeight::class;
    }

    /**
     * Retrieve all records with given filter criteria.
     *
     * @param array      $search
     * @param null|int   $skip
     * @param null|int   $limit
     * @param array      $columns
     * @param null|mixed $key
     * @param null|mixed $value
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function pluck($search = [], $skip = null, $limit = null, $key = null, $value = null)
    {        
        $query = $this->allQuery($search, $skip, $limit);
        $query->with(['goodReceiptItem' => static fn($p) => $p->with(['product', 'goodReceipt' => static fn($q) => $q->with(['partner'])])]);
        return $query->get()->map(function($item){
            return $item->goodReceiptItem->goodReceipt->partner->name.' - '.$item->goodReceiptItem->product->name.' - '.localFormatDate($item->goodReceiptItem->goodReceipt->receipt_date).' - ( '.$item->quantity.' Colly / '.$item->weight.' Kg )';
        })->toArray();
    }

    public function pluckSample($search = [], $skip = null, $limit = null, $key = null, $value = null)
    {        
        $query = $this->allQuery($search, $skip, $limit);
        $query->where(['is_sampling' => true, 'state' => 'classification'])->with(['goodReceiptItem' => static fn($p) => $p->with(['goodReceiptItemSampleClassifications', 'product', 'goodReceipt' => static fn($q) => $q->with(['partner'])])]);
        return $query->get()->mapWithKeys(function($item){    
            $sudahTimbang = $item->goodReceiptItem->goodReceiptItemSampleClassifications->where('reference', $item->id)->sum('weight');            
            $sisaTimbang = $item->weight - $sudahTimbang;
            return [$item->id => $item->goodReceiptItem->goodReceipt->partner->name.' - '.$item->goodReceiptItem->product->name.' - '.$item->goodReceiptItem->goodReceipt->sample.' - '.localFormatDate($item->goodReceiptItem->goodReceipt->receipt_date).' - ( '.$item->quantity.' Colly / '.$item->weight.' Kg ) - ( Sisa '.$sisaTimbang.' Kg)'];
        })->toArray();
    }

    public function pluckNonSample($search = [], $skip = null, $limit = null, $key = null, $value = null)
    {        
        $query = $this->allQuery($search, $skip, $limit);
        $query->where(['is_sampling' => false, 'state' => 'classification'])->with(['goodReceiptItem' => static fn($p) => $p->with(['goodReceiptItemNonSampleClassifications', 'product', 'goodReceipt' => static fn($q) => $q->with(['partner'])])]);
        return $query->get()->groupBy('good_receipt_item_id')->map(function($item){
            $sudahTimbang = $item->first()->goodReceiptItem->goodReceiptItemNonSampleClassifications->sum('weight');
            $sisaTimbang = $item->sum('weight') - $sudahTimbang;
            return $item->first()->goodReceiptItem->goodReceipt->partner->name.' - '.$item->first()->goodReceiptItem->product->name.' - '.$item->first()->goodReceiptItem->goodReceipt->sample.' - '.localFormatDate($item->first()->goodReceiptItem->goodReceipt->receipt_date).' - ( '.$item->sum('quantity').' Colly / '.$item->sum('weight').' Kg ) - ( Sisa '.$sisaTimbang.' Kg)';
        })->toArray();
    }
}
