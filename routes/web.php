<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:owner,manager,supervisor'])->name('dashboard');

Route::get('/pos', function () {
    return view('pos'); // or however we name it later
})->middleware(['auth', 'role:cashier'])->name('pos');

Route::get('/inventory', function () {
    return view('inventory'); // or however we name it later
})->middleware(['auth', 'role:warehouse'])->name('inventory');

require __DIR__.'/auth.php';
