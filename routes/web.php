<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:owner,manager,supervisor'])
    ->name('dashboard');

Route::get('/pos', function () {
    return view('pos'); // or however we name it later
})->middleware(['auth', 'role:cashier'])->name('pos');

Route::get('/inventory', function () {
    return view('inventory'); // or however we name it later
})->middleware(['auth', 'role:warehouse'])->name('inventory');

Route::get('/transactions', function () { return "Halaman Transaksi"; })->middleware(['auth'])->name('transactions');
Route::get('/reports', function () { return "Halaman Laporan"; })->middleware(['auth'])->name('reports');
Route::get('/employees', function () { return "Halaman Karyawan"; })->middleware(['auth'])->name('employees');
Route::get('/branches', function () { return "Halaman Cabang"; })->middleware(['auth'])->name('branches');
Route::get('/customers', function () { return "Halaman Pelanggan"; })->middleware(['auth'])->name('customers');
Route::get('/audit-log', function () { return "Halaman Audit Log"; })->middleware(['auth'])->name('audit-log');
Route::get('/settings', function () { return "Halaman Pengaturan"; })->middleware(['auth'])->name('settings');

require __DIR__.'/auth.php';
