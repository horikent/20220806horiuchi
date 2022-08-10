<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index']);
Route::post('/add', [TodoController::class, 'create']);
Route::post('/edit', [TodoController::class, 'update']);
Route::post('/delete', [TodoController::class, 'remove']);
