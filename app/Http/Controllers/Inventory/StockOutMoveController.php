<?php

namespace App\Http\Controllers\Inventory;

use App\Repositories\Inventory\StockOutMoveRepository;

class StockOutMoveController extends StockMoveController
{
    protected $baseView = 'inventory.stock_moves';
    protected $baseRoute = 'inventory.stockOutMoves';

    public function __construct()
    {
        $this->repository = StockOutMoveRepository::class;
    }
}
