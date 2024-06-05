<?php

namespace App\DataTables\Base;

use App\Models\Base\Partner;
use App\DataTables\BaseDataTable as DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class PartnerDataTable extends DataTable
{
    /**
    * example mapping filter column to search by keyword, default use %keyword%
    */
    private $columnFilterOperator = [
        //'name' => \App\DataTables\FilterClass\MatchKeyword::class,        
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
        return $dataTable->addColumn('action', 'base.partners.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Partner $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Partner $model)
    {
        return $model->select([$model->getTable().'.*'])->newQuery();
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
                       'text' => '<i class="fa fa-plus"></i> ' .__('auth.app.create').''
                    ],
                    [
                       'extend' => 'export',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-download"></i> ' .__('auth.app.export').''
                    ],
                    [
                       'extend' => 'import',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-upload"></i> ' .__('auth.app.import').''
                    ],
                    [
                       'extend' => 'print',
                       'className' => 'btn btn-default btn-sm no-corner',
                       'text' => '<i class="fa fa-print"></i> ' .__('auth.app.print').''
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
        return [
            'code' => new Column(['title' => __('models/partners.fields.code'),'name' => 'code', 'data' => 'code', 'searchable' => true, 'elmsearch' => 'text']),
            'name' => new Column(['title' => __('models/partners.fields.name'),'name' => 'name', 'data' => 'name', 'searchable' => true, 'elmsearch' => 'text']),
            'description' => new Column(['title' => __('models/partners.fields.description'),'name' => 'description', 'data' => 'description', 'searchable' => true, 'elmsearch' => 'text']),
            'active' => new Column(['title' => __('models/partners.fields.active'),'name' => 'active', 'data' => 'active', 'searchable' => true, 'elmsearch' => 'text']),
            'address' => new Column(['title' => __('models/partners.fields.address'),'name' => 'address', 'data' => 'address', 'searchable' => true, 'elmsearch' => 'text']),
            'city' => new Column(['title' => __('models/partners.fields.city'),'name' => 'city', 'data' => 'city', 'searchable' => true, 'elmsearch' => 'text']),
            'email' => new Column(['title' => __('models/partners.fields.email'),'name' => 'email', 'data' => 'email', 'searchable' => true, 'elmsearch' => 'text']),
            'phone' => new Column(['title' => __('models/partners.fields.phone'),'name' => 'phone', 'data' => 'phone', 'searchable' => true, 'elmsearch' => 'text']),
            'mobile' => new Column(['title' => __('models/partners.fields.mobile'),'name' => 'mobile', 'data' => 'mobile', 'searchable' => true, 'elmsearch' => 'text']),
            'additional_info' => new Column(['title' => __('models/partners.fields.additional_info'),'name' => 'additional_info', 'data' => 'additional_info', 'searchable' => true, 'elmsearch' => 'text'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'partners_datatable_' . time();
    }
}
