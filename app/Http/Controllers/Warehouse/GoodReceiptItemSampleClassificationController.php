<?php

namespace App\Http\Controllers\Warehouse;

use App\Repositories\Base\ProductRepository;
use App\Repositories\Warehouse\GoodReceiptItemSampleClassificationRepository;
use App\Repositories\Warehouse\GoodReceiptItemWeightRepository;
use Exception;

class GoodReceiptItemSampleClassificationController extends GoodReceiptItemClassificationController
{
    /** @var  GoodReceiptItemSampleClassificationRepository */
    protected $repository;
    protected $redirectAfterSave = 'warehouse.sampleClassifications.create';

    public function __construct()
    {
        $this->repository = GoodReceiptItemSampleClassificationRepository::class;
    }

    /**
     * Show the form for creating a new GoodReceiptItemClassification.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse.good_receipt_item_sample_classifications.create')->with($this->getOptionItems());
    }
    /**
     * Provide options item based on relationship model GoodReceiptItemClassification from storage.
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function getOptionItems()
    {
        $goodReceiptItem = new GoodReceiptItemWeightRepository();
        $product = new ProductRepository();
        return [
            'goodReceiptItemItems' => ['' => __('crud.option.goodReceiptItem_placeholder')] + $goodReceiptItem->pluckSample(),
            'productItems' => ['' => __('crud.option.product_placeholder')] + $product->bahanBaku(),
        ];
    }
}
