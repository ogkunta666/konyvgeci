<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

// Books routes
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{query}', [BookController::class, 'search']);

// Loans routes
Route::get('/loans', [LoanController::class, 'index']);
Route::post('/loans', [LoanController::class, 'store']);
Route::put('/loans/{id}/return', [LoanController::class, 'update']);





