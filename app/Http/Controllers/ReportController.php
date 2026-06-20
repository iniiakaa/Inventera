<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Inventory;
use App\Models\Scopes\BranchScope;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use App\Exports\StockExport;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function sales(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'export_type' => 'required|in:view,pdf,excel'
        ]);

        $query = Transaction::withoutGlobalScope(BranchScope::class)
                            ->with(['items.product', 'branch', 'user'])
                            ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);

        if ($user->role === 'manager') {
            $query->where('branch_id', $user->branch_id);
        }

        $transactions = $query->orderBy('created_at', 'asc')->get();

        if ($request->export_type === 'pdf') {
            $pdf = Pdf::loadView('reports.exports.sales', [
                'transactions' => $transactions,
                'startDate' => $request->start_date,
                'endDate' => $request->end_date
            ]);
            return $pdf->download('laporan-penjualan-' . date('Ymd') . '.pdf');
        }

        if ($request->export_type === 'excel') {
            return Excel::download(new SalesExport($transactions, $request->start_date, $request->end_date), 'laporan-penjualan-' . date('Ymd') . '.xlsx');
        }

        return back()->with('error', 'Tipe ekspor tidak valid');
    }

    public function stocks(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'export_type' => 'required|in:pdf,excel'
        ]);

        $query = Inventory::withoutGlobalScope(BranchScope::class)->with(['product.category', 'branch']);

        if ($user->role === 'manager' || $user->role === 'warehouse') {
            $query->where('branch_id', $user->branch_id);
            $branchName = $user->branch->name ?? 'Cabang Saya';
        } else {
            $branchName = "Semua Cabang";
        }

        $inventories = $query->get();

        if ($request->export_type === 'pdf') {
            $pdf = Pdf::loadView('reports.exports.stocks', [
                'inventories' => $inventories,
                'branchName' => $branchName
            ]);
            return $pdf->download('laporan-stok-' . date('Ymd') . '.pdf');
        }

        if ($request->export_type === 'excel') {
            return Excel::download(new StockExport($inventories, $branchName), 'laporan-stok-' . date('Ymd') . '.xlsx');
        }

        return back()->with('error', 'Tipe ekspor tidak valid');
    }
}
