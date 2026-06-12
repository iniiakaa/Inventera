<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:owner,manager,supervisor'])
    ->name('dashboard');

use App\Http\Controllers\PosController;

// UC-09, UC-10, UC-11: POS — Kasir only
Route::get('/pos', [PosController::class, 'index'])->middleware(['auth', 'role:cashier'])->name('pos');
Route::post('/pos/checkout', [PosController::class, 'store'])->middleware(['auth', 'role:cashier'])->name('pos.checkout');

// UC-05, UC-06, UC-07, UC-08: Inventori & Gudang — Warehouse, Supervisor, Manager
Route::get('/inventory', function () {
    return view('inventory.index');
})->middleware(['auth', 'role:warehouse,supervisor,manager'])->name('inventory');

// UC-13: Laporan Transaksi — Owner, Manager
Route::get('/transactions', function () { return view('transactions.index'); })->middleware(['auth', 'role:owner,manager'])->name('transactions');

// UC-13, UC-14, UC-16: Laporan & Alert Stok — Owner, Manager
Route::get('/reports', function () { return view('reports.index'); })->middleware(['auth', 'role:owner,manager'])->name('reports');

// UC-03: Kelola Karyawan — Owner, Manager
Route::get('/employees', function () { return view('employees.index'); })->middleware(['auth', 'role:owner,manager'])->name('employees');

// UC-02: Kelola Cabang — Owner only
use App\Http\Controllers\BranchController;
Route::resource('branches', BranchController::class)->except(['show'])->middleware(['auth', 'role:owner']);

// Pelanggan — Owner, Manager
Route::get('/customers', function () { return view('customers.index'); })->middleware(['auth', 'role:owner,manager'])->name('customers');

// UC-15: Audit Log — Owner only
Route::get('/audit-log', function () { return view('audit-log.index'); })->middleware(['auth', 'role:owner'])->name('audit-log');

// UC-02, UC-04: Pengaturan — Owner only
Route::get('/settings', function () { return view('settings.index'); })->middleware(['auth', 'role:owner'])->name('settings');

require __DIR__.'/auth.php';
