<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\BookingController;

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/', [ItemController::class, 'index']);
Route::get('/items/{name}', [ItemController::class, 'show'])->name('items.show');





