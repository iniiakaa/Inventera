<?php

namespace App\Exports;

use App\Models\Inventory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StockExport implements FromView, ShouldAutoSize
{
    protected $inventories;
    protected $branchName;

    public function __construct($inventories, $branchName)
    {
        $this->inventories = $inventories;
        $this->branchName = $branchName;
    }

    public function view(): View
    {
        return view('reports.exports.stocks', [
            'inventories' => $this->inventories,
            'branchName' => $this->branchName
        ]);
    }
}
