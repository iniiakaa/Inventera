<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data dummy sementara
        $data = [
            'total_revenue' => 132000000,
            'branches' => [
                ['name' => 'Jakarta (HQ)', 'revenue' => 4200000000, 'growth' => 12],
                ['name' => 'Bandung', 'revenue' => 2800000000, 'growth' => 8],
                ['name' => 'Surabaya', 'revenue' => 1900000000, 'growth' => -2],
                ['name' => 'Medan', 'revenue' => 3100000000, 'growth' => 15],
                ['name' => 'Makassar', 'revenue' => 1200000000, 'growth' => 4],
            ],
            'critical_stock' => [
                ['name' => 'Indomie Goreng', 'branch' => 'Jakarta Branch', 'quantity' => 2, 'status' => 'critical'],
                ['name' => 'Beras Maknyus 5kg', 'branch' => 'Bandung Branch', 'quantity' => 0, 'status' => 'critical'],
                ['name' => 'Minyak Goreng 2L', 'branch' => 'Surabaya Branch', 'quantity' => 'Low est.', 'status' => 'warning'],
            ],
            'revenue_series' => [310, 400, 280, 510, 420, 109, 1000]
        ];

        return view('dashboard', $data);
    }
}
