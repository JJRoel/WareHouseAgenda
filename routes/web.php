<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdministrationController;

Route::get('/administration/items', [AdministrationController::class, 'index'])->name('administration.items.index');
Route::get('/administration/items/{name}', [AdministrationController::class, 'show'])->name('administration.items.show');
Route::get('/administration/items/all', [AdministrationController::class, 'showAll'])->name('administration.items.showall');
Route::patch('/administration/items/{id}/update-status', [AdministrationController::class, 'updateStatus'])->name('administration.items.updateStatus');

Route::get('/', [ItemController::class, 'index']);
Route::get('/items/{name}', [ItemController::class, 'show']);
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');






