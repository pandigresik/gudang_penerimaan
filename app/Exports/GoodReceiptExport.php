<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class GoodReceiptExport implements FromView
{
    use Exportable;

    /**
     * @var Collection
     */
    protected $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function view(): View
    {
        return view('exports.good_receipt', [
            'goodReceipts' => $this->collection,
        ]);
    }
}

