<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Branch;
use App\Models\Scopes\BranchScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Transaction::with(['branch', 'user', 'items'])
            ->orderBy('created_at', 'desc');

        // Manager hanya lihat cabangnya sendiri, owner lihat semua
        if ($user->role !== 'owner') {
            $query->where('branch_id', $user->branch_id);
        }

        // Filter: cabang (untuk owner)
        if ($user->role === 'owner' && $request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        // Filter: status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter: metode bayar
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter: tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Ringkasan total bulan ini
        $summaryQuery = Transaction::withoutGlobalScope(BranchScope::class)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->where('status', 'completed');

        if ($user->role !== 'owner') {
            $summaryQuery->where('branch_id', $user->branch_id);
        }

        $totalRevenue  = $summaryQuery->sum('total_amount');
        $totalTrx      = $summaryQuery->count();
        $avgTrx        = $totalTrx > 0 ? $totalRevenue / $totalTrx : 0;

        $transactions  = $query->paginate(20)->withQueryString();
        $branches      = $user->role === 'owner' ? Branch::where('is_active', true)->get() : collect();

        return view('transactions.index', compact(
            'transactions', 'branches', 'user',
            'totalRevenue', 'totalTrx', 'avgTrx'
        ));
    }
}
