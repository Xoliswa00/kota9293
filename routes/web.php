<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


    
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

use App\Livewire\Pos\CreateOrder;


Route::get('/pos', CreateOrder::class)
    ->middleware(['auth', 'role:ADMIN,CASHIER'])
    ->name('pos');

    Route::get('/order', \App\Livewire\Customer\OrderMenu::class)
    ->middleware(['auth', 'role:CUSTOMER'])
    ->name('customer.orders');
Route::get('/kitchen', \App\Livewire\Kitchen\Orders::class)
    ->middleware(['auth', 'role:ADMIN,CASHIER'])
    ->name('kitchen.orders');


require __DIR__.'/auth.php';
