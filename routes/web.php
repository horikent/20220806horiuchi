<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index']);
Route::get('/add', [TodoController::class, 'add']);
Route::post('/add', [TodoController::class, 'create']);
Route::get('/edit', [TodoController::class, 'edit']);
Route::post('/edit', [TodoController::class, 'update']);
Route::get('/delete', [TodoController::class, 'delete']);
Route::post('/delete', [TodoController::class, 'remove']);
