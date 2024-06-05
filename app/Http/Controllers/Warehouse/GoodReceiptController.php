<?php

namespace App\Http\Controllers\Warehouse;

use App\DataTables\Warehouse\GoodReceiptDataTable;
use App\Http\Requests\Warehouse\CreateGoodReceiptRequest;
use App\Http\Requests\Warehouse\UpdateGoodReceiptRequest;
use App\Repositories\Warehouse\GoodReceiptRepository;
use App\Repositories\Base\PartnerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Warehouse\GoodReceipt;
use App\Repositories\Base\ProductRepository;
use Response;
use Exception;
use Illuminate\Http\Request;

class GoodReceiptController extends AppBaseController
{
    /** @var  GoodReceiptRepository */
    protected $repository;

    public function __construct()
    {
        $this->repository = GoodReceiptRepository::class;
    }

    /**
     * Display a listing of the GoodReceipt.
     *
     * @param GoodReceiptDataTable $goodReceiptDataTable
     * @return Response
     */
    public function index(GoodReceiptDataTable $goodReceiptDataTable)
    {
        return $goodReceiptDataTable->render('warehouse.good_receipts.index');
    }

    /**
     * Show the form for creating a new GoodReceipt.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse.good_receipts.create')->with($this->getOptionItems());
    }

    /**
     * Store a newly created GoodReceipt in storage.
     *
     * @param CreateGoodReceiptRequest $request
     *
     * @return Response
     */
    public function store(CreateGoodReceiptRequest $request)
    {
        $input = $request->all();

        $goodReceipt = $this->getRepositoryObj()->create($input);
        if($goodReceipt instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $goodReceipt->getMessage()]);
        }
        
        Flash::success(__('messages.saved', ['model' => __('models/goodReceipts.singular')]));

        return redirect(route('warehouse.goodReceipts.create'));
    }

    /**
     * Display the specified GoodReceipt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $goodReceipt = $this->getRepositoryObj()->find($id);

        if (empty($goodReceipt)) {
            Flash::error(__('models/goodReceipts.singular').' '.__('messages.not_found'));

            return redirect(route('warehouse.goodReceipts.index'));
        }

        return view('warehouse.good_receipts.show')->with('goodReceipt', $goodReceipt);
    }

    /**
     * Show the form for editing the specified GoodReceipt.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $goodReceipt = $this->getRepositoryObj()->find($id);

        if (empty($goodReceipt)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceipts.singular')]));

            return redirect(route('warehouse.goodReceipts.index'));
        }
        
        return view('warehouse.good_receipts.edit')->with('goodReceipt', $goodReceipt)->with($this->getOptionItems());
    }

    /**
     * Update the specified GoodReceipt in storage.
     *
     * @param  int              $id
     * @param UpdateGoodReceiptRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGoodReceiptRequest $request)
    {
        $goodReceipt = $this->getRepositoryObj()->find($id);

        if (empty($goodReceipt)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceipts.singular')]));

            return redirect(route('warehouse.goodReceipts.index'));
        }

        $goodReceipt = $this->getRepositoryObj()->update($request->all(), $id);
        if($goodReceipt instanceof Exception){
            return redirect()->back()->withInput()->withErrors(['error', $goodReceipt->getMessage()]);
        }

        Flash::success(__('messages.updated', ['model' => __('models/goodReceipts.singular')]));

        return redirect(route('warehouse.goodReceipts.index'));
    }

    /**
     * Remove the specified GoodReceipt from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $goodReceipt = $this->getRepositoryObj()->find($id);

        if (empty($goodReceipt)) {
            Flash::error(__('messages.not_found', ['model' => __('models/goodReceipts.singular')]));

            return redirect(route('warehouse.goodReceipts.index'));
        }

        $delete = $this->getRepositoryObj()->delete($id);
        
        if($delete instanceof Exception){
            return redirect()->back()->withErrors(['error', $delete->getMessage()]);
        }

        Flash::success(__('messages.deleted', ['model' => __('models/goodReceipts.singular')]));

        return redirect(route('warehouse.goodReceipts.index'));
    }

    public function excel(Request $request)
    {                
        $startDate = $endDate = false;
        $receiptDate = $request->get('receiptDate');
        $partnerId = $request->get('partnerId');
        if($receiptDate){
            list($startDate, $endDate) = explode('__', $receiptDate);
        }        
        $modelEksport = '\\App\Exports\\GoodReceiptExport';
        $fileName = 'rekap_penerimaan_'.$startDate.'_'.$endDate;
        $collection = GoodReceipt::with(['partner', 'goodReceiptItems' => static fn($q) => $q->with(['product', 'goodReceiptItemWeights', 'goodReceiptItemClassifications' => static fn($r) => $r->with(['product'])])])
                        ->when($startDate, static fn($q) => $q->whereBetween('receipt_date', [$startDate, $endDate]))
                        ->when($partnerId, static fn($q) => $q->where('partner_id', $partnerId))
                        ->get();        
        //dd(view('exports.good_receipt', ['goodReceipts' => $collection])->render());
        return (new $modelEksport($collection))           
            ->download($fileName.'.xls');
    }

    /**
     * Provide options item based on relationship model GoodReceipt from storage.         
     *
     * @throws \Exception
     *
     * @return array
     */
    private function getOptionItems(){        
        $partner = new PartnerRepository();
        $product = new ProductRepository();
        return [
            'partnerItems' => ['' => __('crud.option.partner_placeholder')] + $partner->pluck(),
            'productItems' => $product->bahanMentah()
        ];            
    }
}
