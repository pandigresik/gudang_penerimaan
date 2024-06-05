<?php

namespace App\DataTables\Warehouse;

use App\Models\Warehouse\GoodReceipt;
use App\DataTables\BaseDataTable as DataTable;
use App\Repositories\Base\PartnerRepository;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class GoodReceiptDataTable extends DataTable
{
    protected $fastExcel = false;
    protected $exportColumns = [        
        ['data' => 'partner.name', 'defaultContent' => '','title' => 'Suppllier'],
        ['data' => 'receipt_date', 'defaultContent' => '','title' => 'Tanggal'],        
        ['data' => 'weight', 'defaultContent' => '','title' => 'Hasil Timbang'],
    ];
    /**
    * example mapping filter column to search by keyword, default use %keyword%
    */
    private $columnFilterOperator = [
        'partner_id' => \App\DataTables\FilterClass\MatchKeyword::class,
    ];
    
    private $mapColumnSearch = [
        //'entity.name' => 'entity_id',
    ];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        if (!empty($this->columnFilterOperator)) {
            foreach ($this->columnFilterOperator as $column => $operator) {
                $columnSearch = $this->mapColumnSearch[$column] ?? $column;
                $dataTable->filterColumn($column, new $operator($columnSearch));                
            }
        }
        $dataTable->editColumn('receipt_date', static fn($q) => localFormatDate($q->receipt_date));                
        $dataTable->editColumn('weight', function($q){
            $result = [];
            $q->goodReceiptItems->each(function($r) use(&$result){
                $buttonSample = '';
                $buttonNonSample = '';
                if(!$r->goodReceiptItemSampleClassifications->isEmpty()){
                    $buttonSample = '<button class="btn btn-warning btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.$r->id.'-sample" aria-expanded="false">Hasil Sorting Sample</button>';
                }
                if(!$r->goodReceiptItemNonSampleClassifications->isEmpty()){
                    $buttonNonSample = '<button class="btn btn-danger btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.$r->id.'-nonsample" aria-expanded="false">Hasil Sorting Non Sample</button>';
                }
                $tmp = '<div class="card mb-3">
                    <div class="card-header">'.$r->product->name.'  
                        &nbsp;&nbsp;<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.$r->id.'" aria-expanded="false">Hasil Timbang</button>
                        '.$buttonSample.'
                        '.$buttonNonSample.'
                    </div>
                    <div class="card-body collapse" id="collapse-'.$r->id.'">
                        <caption>Hasil Penimbangan</caption>
                        <table class="table table-bordered text-center">
                        <thead><tr><th>No</th><th>Quantity</th><th>Berat</th><th>Sample</th></tr></thead>
                        <tbody>
                ';
                $r->goodReceiptItemWeights->each(function($s, $key) use(&$tmp){
                    $tmp .= '<tr class="'.($s->is_sampling ? 'bg-warning' : '').'">
                            <td>'.($key + 1).'</td>
                            <td class="text-end">'.$s->quantity.'</td>
                            <td class="text-end">'.$s->weight.'</td>
                            <td>'.($s->is_sampling ? 'Ya' : 'Tidak').'</td>
                        </tr>';    
                });
                $tmp .= '</tbody></table></div>';
                // jika punya hasil yang disortir maka tampilkan juga
                if(!$r->goodReceiptItemSampleClassifications->isEmpty()){
                    $tmp .= '<div class="card-body  border border-warning collapse" id="collapse-'.$r->id.'-sample">
                        <caption>Hasil Sortir Sample</caption>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Hasil Timbang</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $r->goodReceiptItemSampleClassifications->groupBy('product_id')->each(function($s) use(&$tmp){
                                $tmp .= '<tr>
                                    <td>'.$s->first()->product->name.'</td>
                                    <td class="text-end">'.$s->sum('weight').'</td>
                                </tr>';
                                
                            });
                    $tmp .= '</tbody>
                        </table>
                        </div>';
                }
                if(!$r->goodReceiptItemNonSampleClassifications->isEmpty()){
                    $tmp .= '<div class="card-body border border-danger collapse" id="collapse-'.$r->id.'-nonsample">                    
                    <caption>Hasil Sortir Bukan Sample</caption>
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Hasil Timbang</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $r->goodReceiptItemNonSampleClassifications->groupBy('product_id')->each(function($s) use(&$tmp){
                                $tmp .= '<tr>
                                    <td>'.$s->first()->product->name.'</td>
                                    <td class="text-end">'.$s->sum('weight').'</td>
                                </tr>';
                                
                            });
                    $tmp .= '</tbody>
                        </table>
                        </div>';
                }
                $tmp .= '</div>';
                $result[] = $tmp;
            });
            return implode('', $result);
        });
        $dataTable->rawColumns(['weight', 'action']);
        return $dataTable->addColumn('action', 'warehouse.good_receipts.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\GoodReceipt $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(GoodReceipt $model)
    {
        return $model->with(['partner', 'goodReceiptItems' => static fn($q) => $q->with(['product', 'goodReceiptItemWeights', 'goodReceiptItemSampleClassifications' => static fn($r) => $r->with(['product']), 'goodReceiptItemNonSampleClassifications' => static fn($r) => $r->with(['product'])])])->select([$model->getTable().'.*'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $buttons = [                    
            [
                'extend' => 'create',
                'className' => 'btn btn-default btn-sm no-corner',
                'text' => '<i class="fa fa-file-excel-o"></i> Excel',
                'action' => <<<FUNC
                    function(e, dt, button, config){
                        const table = window.LaravelDataTables.dataTableBuilder
                        const _tr = $('#dataTableBuilder tr:eq(1)')
                        const _columnSearch = []
                        _tr.find('th').each(function(i, elm){                            
                            let _searchValue = []                            
                            $(elm).find('input, select').each(function(j, _input){
                                let _searchValueTmp = $(_input).val()
                                
                                const _className = _input.className
                                if(_.includes(_className,'datetime')){
                                    _searchValueTmp = main.getValueDateSQL(_input)
                                }
                                if(_.includes(_className,'inputmask')){
                                    const _optionMask = $(_input).data('optionmask') || {}
                                    _searchValueTmp = $(_input).inputmask('unmaskedvalue')
                                    if (_optionMask.radixPoint === ',') {
                                        _searchValueTmp = _searchValueTmp.replace(',', '.')
                                    }
                                }
                                _searchValue.push(_searchValueTmp)
                            })
                            _columnSearch[i] = _.join(_searchValue,'__')
                            
                        })
                        const _partnerId = _columnSearch[0]
                        const _receiptDate = _columnSearch[1]                                                
                        button.data('url', 'warehouse/goodReceipts/excel?partnerId='+_partnerId+'&receiptDate='+_receiptDate)
                        button.data('target', '_parent')
                        button.data('tipe', 'get')                        
                        main.redirectUrl(button)
                    }
FUNC
            ],
                    [
                       'extend' => 'reset',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-undo"></i> ' .__('auth.app.reset').''
                    ],
                    [
                       'extend' => 'reload',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-refresh"></i> ' .__('auth.app.reload').''
                    ],
                ];
                
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => __('crud.action')])
            ->parameters([
                'dom'       => '<"row" <"col-md-6"B><"col-md-6 text-end"l>>rtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => $buttons,
                 'language' => [
                   'url' => url('vendor/datatables/i18n/en-gb.json'),
                 ],
                 'responsive' => true,
                 'fixedHeader' => true,
                 'orderCellsTop' => true     
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $partnerRepository = new PartnerRepository();
        $partnerItems = array_merge([['text' => 'Pilih '.__('models/productCategories.fields.singular'), 'value' => '']], convertArrayPairValueWithKey($partnerRepository->pluck()));
        return [
            'partner_id' => new Column(['title' => __('models/goodReceipts.fields.partner_id'),'name' => 'partner_id', 'data' => 'partner.name', 'searchable' => true, 'elmsearch' => 'dropdown', 'listItem' => $partnerItems]),
            'receipt_date' => new Column(['title' => __('models/goodReceipts.fields.receipt_date'),'name' => 'receipt_date', 'data' => 'receipt_date', 'searchable' => true, 'elmsearch' => 'daterange']),            
            'sample' => new Column(['title' => __('models/goodReceipts.fields.sample'),'name' => 'receipt_date', 'data' => 'sample', 'searchable' => true, 'elmsearch' => 'text']),
            'weight' => new Column(['title' => __('models/goodReceiptItemWeights.fields.weight'),'name' => 'weight', 'data' => 'weight', 'searchable' => false, 'elmsearch' => 'text']),
            // 'state' => new Column(['title' => __('models/goodReceipts.fields.state'),'name' => 'state', 'data' => 'state', 'searchable' => true, 'elmsearch' => 'text']),
            // 'description' => new Column(['title' => __('models/goodReceipts.fields.description'),'name' => 'description', 'data' => 'description', 'searchable' => true, 'elmsearch' => 'text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'good_receipts_datatable_' . time();
    }
}
