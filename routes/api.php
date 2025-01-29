<?php
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::post('/translations', [TranslationController::class, 'store']);
    Route::put('/translations/{id}', [TranslationController::class, 'update']);
    Route::get('/translations/{id}', [TranslationController::class, 'show']);
    Route::get('/translations/search', [TranslationController::class, 'search']);
    Route::get('/translations/export', [TranslationController::class, 'export']);

});
