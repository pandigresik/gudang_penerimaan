<?php

namespace App\Http\Controllers\Warehouse;

use App\DataTables\Warehouse\GoodReceiptItemClassificationDataTable;
use App\Http\Requests\Warehouse\CreateGoodReceiptItemClassificationRequest;
use App\Http\Requests\Warehouse\UpdateGoodReceiptItemClassificationRequest;
use App\Repositories\Warehouse\GoodReceiptItemClassificationRepository;
use App\Repositories\Base\ProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Warehouse\GoodReceiptItemWeightRepository;
use Response;
use Exception;

class GoodReceiptItemClassificationController extends AppBaseController
{
    /** @var  GoodReceiptItemClassificationRepository */
    protected $repository;
    protected $redirectAfterSave = 'warehouse.goodReceiptItemClassifications.create';

    public function __construct()
    {
        $this->repository = GoodReceiptItemClassificationRepository::class;
    }

    /**
     * Display a listing of the GoodReceiptItemClassification.
     *
     * @param GoodReceiptItemClassificationDataTable $goodReceiptItemClassificationDataTable
     * @return Response
     */
    public function index(GoodReceiptItemClassificationDataTable $goodReceiptItemClassificationDataTable)
    {
        return $goodReceiptItemClassificationDataTable->render('warehouse.good_receipt_item_classifications.index');
    }

    /**
     * Show the form for creating a new GoodReceiptItemClassification.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse.good_receipt_item_classifications.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created GoodReceiptItemClassification in storage.
     *
     * @param CreateGoodReceiptItemClassificationRequest $request
     *
     * @return Response
     */
    public function store(CreateGoodReceiptItemClassificationRequest $request)
    {
        $input = $request->all();

        $goodReceiptItemClassification = $this->getRepositoryObj()->create($input);
        if($goodReceiptItemClassification instanceof Exception) {
            return redirect()->back()->withInput()->withErrors(['error', $goodReceiptItemClassification->getMessage()]);
        }

        Flash::success(__('messages.saved', ['model' => __('models/goodReceiptItemClassifications.singular')]));

        return redirect(route($this->redirectAfterSave));
    }

    /**
     * Display the specified GoodReceiptItemClassification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $goodReceiptItemClassification = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemClassification)) {
            Flash::error(__('models/goodReceiptItemClassifications.singular').' '.__('messages.not_found'));

            return redirect(route('warehouse.goodReceiptItemClassifications.index'));
        }

        return view('warehouse.good_receipt_item_classifications.show')->with('goodReceiptItemClassification', $goodReceiptItemClassification);
    }

    /**
     * Show the form for editing the specified GoodReceiptItemClassification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $goodReceiptItemClassification = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemClassification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItemClassifications.singular')]));

            return redirect(route('warehouse.goodReceiptItemClassifications.index'));
        }

        return view('warehouse.good_receipt_item_classifications.edit')->with('goodReceiptItemClassification', $goodReceiptItemClassification)->with($this->getOptionItems());
    }

    /**
     * Update the specified GoodReceiptItemClassification in storage.
     *
     * @param  int              $id
     * @param UpdateGoodReceiptItemClassificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGoodReceiptItemClassificationRequest $request)
    {
        $goodReceiptItemClassification = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemClassification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItemClassifications.singular')]));

            return redirect(route('warehouse.goodReceiptItemClassifications.index'));
        }

        $goodReceiptItemClassification = $this->getRepositoryObj()->update($request->all(), $id);
        if($goodReceiptItemClassification instanceof Exception) {
            return redirect()->back()->withInput()->withErrors(['error', $goodReceiptItemClassification->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/goodReceiptItemClassifications.singular')]));

        return redirect(route('warehouse.goodReceiptItemClassifications.index'));
    }

    /**
     * Remove the specified GoodReceiptItemClassification from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $goodReceiptItemClassification = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemClassification)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItemClassifications.singular')]));

            return redirect(route('warehouse.goodReceiptItemClassifications.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);

        if($delete instanceof Exception) {
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/goodReceiptItemClassifications.singular')]));

        return redirect(route('warehouse.goodReceiptItemClassifications.index'));
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
            'goodReceiptItemItems' => ['' => __('crud.option.goodReceiptItem_placeholder')] + $goodReceiptItem->pluckNonSample(),
            'productItems' => ['' => __('crud.option.product_placeholder')] + $product->pluck()
        ];
    }
}
