<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\Scopes\BranchScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'cashier') {
            return redirect()->route('pos');
        }
        if ($user->role === 'warehouse') {
            return redirect()->route('inventory.index');
        }

        // Query Base Total Revenue (This Month)
        $revenueQuery = Transaction::withoutGlobalScope(BranchScope::class)
                                   ->whereMonth('created_at', date('m'))
                                   ->whereYear('created_at', date('Y'));
        
        if ($user->role !== 'owner') {
            $revenueQuery->where('branch_id', $user->branch_id);
        }
        $totalRevenue = $revenueQuery->sum('total_amount');

        // Query Branches Revenue
        $branchesData = [];
        if ($user->role === 'owner') {
            $branches = Branch::withSum(['transactions' => function($q) {
                $q->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
            }], 'total_amount')->get();

            foreach ($branches as $branch) {
                $branchesData[] = [
                    'name' => $branch->name,
                    'revenue' => $branch->transactions_sum_total_amount ?? 0,
                    'growth' => rand(-5, 15)
                ];
            }
        } else {
            $branch = Branch::withSum(['transactions' => function($q) {
                $q->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'));
            }], 'total_amount')->where('id', $user->branch_id)->first();

            if ($branch) {
                $branchesData[] = [
                    'name' => $branch->name,
                    'revenue' => $branch->transactions_sum_total_amount ?? 0,
                    'growth' => rand(-5, 15)
                ];
            }
        }

        // Query Critical Stock — owner lihat semua, non-owner lihat per cabang
        $stockQuery = Inventory::withoutGlobalScope(BranchScope::class)->with(['product', 'branch']);
        if ($user->role !== 'owner') {
            $stockQuery->where('branch_id', $user->branch_id);
        }
        
        $criticalStocks = $stockQuery->get()->filter(function ($inv) {
            return $inv->stock <= $inv->min_stock;
        })->map(function ($inv) {
            return [
                'name' => $inv->product->name ?? 'Unknown',
                'branch' => $inv->branch->name ?? 'Unknown',
                'quantity' => $inv->stock,
                'status' => $inv->stock == 0 ? 'critical' : 'warning'
            ];
        })->take(5)->toArray();

        // Revenue series — 7 hari terakhir, data nyata dari DB
        $revenueSeries = [];
        $revenueLabels = [];
        $prevRevenueSeries = [];

        for ($i = 6; $i >= 0; $i--) {
            $date     = now()->subDays($i);
            $datePrev = now()->subDays($i)->subMonth();

            // Hari ini & 6 hari sebelumnya
            $q = Transaction::withoutGlobalScope(BranchScope::class)
                ->whereDate('created_at', $date)
                ->where('status', 'completed');
            if ($user->role !== 'owner') {
                $q->where('branch_id', $user->branch_id);
            }
            $revenueSeries[] = (float) $q->sum('total_amount');
            $revenueLabels[] = $date->locale('id')->isoFormat('ddd, D MMM');

            // Periode sama bulan lalu
            $qPrev = Transaction::withoutGlobalScope(BranchScope::class)
                ->whereDate('created_at', $datePrev)
                ->where('status', 'completed');
            if ($user->role !== 'owner') {
                $qPrev->where('branch_id', $user->branch_id);
            }
            $prevRevenueSeries[] = (float) $qPrev->sum('total_amount');
        }

        $data = [
            'total_revenue' => $totalRevenue,
            'branches' => $branchesData,
            'critical_stock' => $criticalStocks,
            'revenue_series' => $revenueSeries,
            'revenue_labels' => $revenueLabels,
            'prev_revenue_series' => $prevRevenueSeries,
            'role' => $user->role,
            'user' => $user
        ];

        return view('dashboard.index', $data);
    }
}
