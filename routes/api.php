<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AddressLookupController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/address-lookup', [AddressLookupController::class, 'search'])->name('address-lookup.search');
Route::get('/address-lookup/{id}', [AddressLookupController::class, 'getById'])->name('address-lookup.get-by-id');

Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
Route::get('/addresses/{address:id}', [AddressController::class, 'show'])->name('addresses.show');
