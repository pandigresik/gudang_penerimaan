<?php

namespace App\Http\Controllers\Warehouse;

use App\DataTables\Warehouse\GoodReceiptItemDataTable;
use App\Http\Requests\Warehouse\CreateGoodReceiptItemRequest;
use App\Http\Requests\Warehouse\UpdateGoodReceiptItemRequest;
use App\Repositories\Warehouse\GoodReceiptItemRepository;
use App\Repositories\Warehouse\GoodReceiptRepository;
use App\Repositories\Base\ProductRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class GoodReceiptItemController extends AppBaseController
{
    /** @var  GoodReceiptItemRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = GoodReceiptItemRepository::class;
    }

    /**
     * Display a listing of the GoodReceiptItem.
     *
     * @param GoodReceiptItemDataTable $goodReceiptItemDataTable
     * @return Response
     */
    public function index(GoodReceiptItemDataTable $goodReceiptItemDataTable)
    {
        return $goodReceiptItemDataTable->render('warehouse.good_receipt_items.index');
    }

    /**
     * Show the form for creating a new GoodReceiptItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse.good_receipt_items.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created GoodReceiptItem in storage.
     *
     * @param CreateGoodReceiptItemRequest $request
     *
     * @return Response
     */
    public function store(CreateGoodReceiptItemRequest $request)
    {
        $input = $request->all();

        $goodReceiptItem = $this->getRepositoryObj()->create($input);
        if($goodReceiptItem instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $goodReceiptItem->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/goodReceiptItems.singular')]));

        return redirect(route('warehouse.goodReceiptItems.index'));
    }

    /**
     * Display the specified GoodReceiptItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $goodReceiptItem = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItem)) {
            Flash::error(__('models/goodReceiptItems.singular').' '.__('messages.not_found'));

            return redirect(route('warehouse.goodReceiptItems.index'));
        }

        return view('warehouse.good_receipt_items.show')->with('goodReceiptItem', $goodReceiptItem);
    }

    /**
     * Show the form for editing the specified GoodReceiptItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $goodReceiptItem = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItems.singular')]));

            return redirect(route('warehouse.goodReceiptItems.index'));
        }
        
        return view('warehouse.good_receipt_items.edit')->with('goodReceiptItem', $goodReceiptItem)->with($this->getOptionItems());
    }

    /**
     * Update the specified GoodReceiptItem in storage.
     *
     * @param  int              $id
     * @param UpdateGoodReceiptItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGoodReceiptItemRequest $request)
    {
        $goodReceiptItem = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItems.singular')]));

            return redirect(route('warehouse.goodReceiptItems.index'));
        }

        $goodReceiptItem = $this->getRepositoryObj()->update($request->all(), $id);
        if($goodReceiptItem instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $goodReceiptItem->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/goodReceiptItems.singular')]));

        return redirect(route('warehouse.goodReceiptItems.index'));
    }

    /**
     * Remove the specified GoodReceiptItem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $goodReceiptItem = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItem)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItems.singular')]));

            return redirect(route('warehouse.goodReceiptItems.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/goodReceiptItems.singular')]));

        return redirect(route('warehouse.goodReceiptItems.index'));
    }

    /**
     * Provide options item based on relationship model GoodReceiptItem from storage.         
     *
     * @throws \Exception
     *
     * @return array
     */
    private function getOptionItems(){        
        $goodReceipt = new GoodReceiptRepository();
        $product = new ProductRepository();
        return [
            'goodReceiptItems' => ['' => __('crud.option.goodReceipt_placeholder')] + $goodReceipt->pluck(),
            'productItems' => ['' => __('crud.option.product_placeholder')] + $product->pluck()            
        ];
    }
}
