<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationLogController;

Route::get('/', function () {
    return redirect()->route('donors.index');
});

Route::resource('donors', DonorController::class)
    ->only(['index', 'create', 'store', 'update']);

Route::resource('donation-logs', DonationLogController::class)
    ->only(['index', 'create', 'store', 'update']);