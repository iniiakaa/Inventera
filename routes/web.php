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

Route::get('/transactions', function () {
    return "Halaman Transaksi"; 
})->middleware(['auth'])->name('transactions');

Route::get('/reports', function () {
    return "Halaman Laporan"; 
})->middleware(['auth'])->name('reports');

require __DIR__.'/auth.php';
