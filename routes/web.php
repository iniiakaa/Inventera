<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:owner,manager,supervisor'])
    ->name('dashboard');

// UC-09, UC-10, UC-11: POS — Kasir only
Route::get('/pos', [PosController::class, 'index'])->middleware(['auth', 'role:cashier'])->name('pos');
Route::post('/pos/checkout', [PosController::class, 'store'])->middleware(['auth', 'role:cashier'])->name('pos.checkout');

// UC-05, UC-06, UC-07, UC-08: Inventori & Gudang — Warehouse, Supervisor, Manager
Route::resource('inventory', \App\Http\Controllers\InventoryController::class)->except(['show'])->middleware(['auth', 'role:owner,manager,supervisor,warehouse']);

// Suppliers
Route::resource('suppliers', SupplierController::class)->except(['show'])->middleware(['auth', 'role:owner,manager,warehouse']);

// Purchase Orders (Inbound)
Route::resource('purchase-orders', PurchaseOrderController::class)->except(['destroy'])->middleware(['auth', 'role:owner,manager,supervisor,warehouse']);

// Stock Opname
Route::resource('stock-opnames', StockOpnameController::class)->except(['destroy'])->middleware(['auth', 'role:owner,manager,supervisor,warehouse']);

// UC-13: Laporan Transaksi — Owner, Manager
Route::get('/transactions', [TransactionController::class, 'index'])->middleware(['auth', 'role:owner,manager'])->name('transactions');

// UC-13, UC-14, UC-16:// Laporan & Analitik — Owner, Manager
Route::middleware(['auth', 'role:owner,manager'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::post('/reports/stocks', [ReportController::class, 'stocks'])->name('reports.stocks');
});

// Audit Trail / Activity Logs — Owner
Route::get('/activity-logs', [ActivityLogController::class, 'index'])->middleware(['auth', 'role:owner'])->name('activity-logs.index');


// ==========================================
// UC-03: Kelola Karyawan — Owner, Manager
// ==========================================

// 1. Route tambahan untuk toggle status aktif/nonaktif cepat dari tabel
Route::patch('/employees/{id}/toggle-status', [EmployeeController::class, 'toggleStatus'])
    ->middleware(['auth', 'role:owner,manager'])
    ->name('employees.toggle-status');

// 2. Resource route (Meng-handle index, create, store, edit, update, dan destroy/drop murni)
Route::resource('employees', EmployeeController::class)
    ->except(['show'])
    ->names([
        'index' => 'employees' // Trik nama 'employees' agar link lama tidak patah
    ])
    ->middleware(['auth', 'role:owner,manager']);


// UC-02: Kelola Cabang — Owner only
Route::resource('branches', BranchController::class)->except(['show'])->middleware(['auth', 'role:owner']);

// Master Data: Kategori & Produk — Owner, Manager, Supervisor, Warehouse
Route::resource('categories', CategoryController::class)->except(['show'])->middleware(['auth', 'role:owner,manager,supervisor,warehouse']);
Route::resource('products', ProductController::class)->except(['show'])->middleware(['auth', 'role:owner,manager,supervisor,warehouse']);

// Pelanggan — Owner, Manager
Route::get('/customers', function () { return view('customers.index'); })->middleware(['auth', 'role:owner,manager'])->name('customers');

// UC-15: Audit Log — Owner only
Route::get('/audit-log', function () { return view('audit-log.index'); })->middleware(['auth', 'role:owner'])->name('audit-log');

// UC-02, UC-04: Pengaturan — Owner only
Route::get('/settings', function () { return view('settings.index'); })->middleware(['auth', 'role:owner'])->name('settings');

require __DIR__.'/auth.php';