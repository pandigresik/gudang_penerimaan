<?php

namespace App\Http\Controllers\Warehouse;

use App\DataTables\Warehouse\GoodReceiptItemWeightDataTable;
use App\Http\Requests\Warehouse\CreateGoodReceiptItemWeightRequest;
use App\Http\Requests\Warehouse\UpdateGoodReceiptItemWeightRequest;
use App\Repositories\Warehouse\GoodReceiptItemWeightRepository;
use App\Repositories\Warehouse\GoodReceiptItemRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Exception;

class GoodReceiptItemWeightController extends AppBaseController
{
    /** @var  GoodReceiptItemWeightRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = GoodReceiptItemWeightRepository::class;
    }

    /**
     * Display a listing of the GoodReceiptItemWeight.
     *
     * @param GoodReceiptItemWeightDataTable $goodReceiptItemWeightDataTable
     * @return Response
     */
    public function index(GoodReceiptItemWeightDataTable $goodReceiptItemWeightDataTable)
    {
        return $goodReceiptItemWeightDataTable->render('warehouse.good_receipt_item_weights.index');
    }

    /**
     * Show the form for creating a new GoodReceiptItemWeight.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse.good_receipt_item_weights.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created GoodReceiptItemWeight in storage.
     *
     * @param CreateGoodReceiptItemWeightRequest $request
     *
     * @return Response
     */
    public function store(CreateGoodReceiptItemWeightRequest $request)
    {
        $input = $request->all();

        $goodReceiptItemWeight = $this->getRepositoryObj()->create($input);
        if($goodReceiptItemWeight instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $goodReceiptItemWeight->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/goodReceiptItemWeights.singular')]));

        return redirect(route('warehouse.goodReceiptItemWeights.index'));
    }

    /**
     * Display the specified GoodReceiptItemWeight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $goodReceiptItemWeight = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemWeight)) {
            Flash::error(__('models/goodReceiptItemWeights.singular').' '.__('messages.not_found'));

            return redirect(route('warehouse.goodReceiptItemWeights.index'));
        }

        return view('warehouse.good_receipt_item_weights.show')->with('goodReceiptItemWeight', $goodReceiptItemWeight);
    }

    /**
     * Show the form for editing the specified GoodReceiptItemWeight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $goodReceiptItemWeight = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemWeight)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItemWeights.singular')]));

            return redirect(route('warehouse.goodReceiptItemWeights.index'));
        }
        
        return view('warehouse.good_receipt_item_weights.edit')->with('goodReceiptItemWeight', $goodReceiptItemWeight)->with($this->getOptionItems());
    }

    /**
     * Update the specified GoodReceiptItemWeight in storage.
     *
     * @param  int              $id
     * @param UpdateGoodReceiptItemWeightRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGoodReceiptItemWeightRequest $request)
    {
        $goodReceiptItemWeight = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemWeight)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItemWeights.singular')]));

            return redirect(route('warehouse.goodReceiptItemWeights.index'));
        }

        $goodReceiptItemWeight = $this->getRepositoryObj()->update($request->all(), $id);
        if($goodReceiptItemWeight instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $goodReceiptItemWeight->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/goodReceiptItemWeights.singular')]));

        return redirect(route('warehouse.goodReceiptItemWeights.index'));
    }

    /**
     * Remove the specified GoodReceiptItemWeight from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $goodReceiptItemWeight = $this->getRepositoryObj()->find($id);

        if (empty($goodReceiptItemWeight)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceiptItemWeights.singular')]));

            return redirect(route('warehouse.goodReceiptItemWeights.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/goodReceiptItemWeights.singular')]));

        return redirect(route('warehouse.goodReceiptItemWeights.index'));
    }

    /**
     * Provide options item based on relationship model GoodReceiptItemWeight from storage.         
     *
     * @throws \Exception
     *
     * @return Response
     */
    private function getOptionItems(){        
        $goodReceiptItem = new GoodReceiptItemRepository();
        return [
            'goodReceiptItemItems' => ['' => __('crud.option.goodReceiptItem_placeholder')] + $goodReceiptItem->pluck()            
        ];
    }
}
