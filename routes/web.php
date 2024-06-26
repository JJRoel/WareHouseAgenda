<?php

use App\Http\Controllers\AdministrationController;

Route::get('administration/items', [AdministrationController::class, 'index'])->name('administration.items.index');
Route::get('administration/items/show/{name}', [AdministrationController::class, 'show'])->name('administration.items.show');
Route::get('administration/items/showall', [AdministrationController::class, 'showAll'])->name('administration.items.showall');
Route::patch('administration/items/updateStatus/{id}', [AdministrationController::class, 'updateStatus'])->name('administration.items.updateStatus');
Route::patch('administration/items/updateName/{id}', [AdministrationController::class, 'updateName'])->name('administration.items.updateName');

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ItemController;

Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{groupid}', [ItemController::class, 'show']);
Route::patch('/items/updateStatus/{id}', [ItemController::class, 'updateStatus'])->name('items.updateStatus');
Route::patch('/items/updateName/{id}', [ItemController::class, 'updateName'])->name('items.updateName');

// Ensure other routes remain unchanged
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');






Route::get('/test-route', function () {
    $items = \App\Models\ItemId::all(); // Fetch the items just like in the controller method
    return view('test-view', compact('items'));
});
