<?php

use App\Http\Controllers\ConfrontosController;
use App\Http\Controllers\TimesController;
use Illuminate\Support\Facades\Route;


Route::prefix('times')->group(function () {
    Route::get('classificados', [TimesController::class, 'classificados']);
});

Route::prefix('confrontos')->group(function () {
    Route::post('', [ConfrontosController::class, 'create']);
});
