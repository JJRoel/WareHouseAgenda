<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\BookingController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/items/{name}', [ItemController::class, 'show']);
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');






