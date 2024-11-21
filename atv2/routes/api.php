<?php

use App\Http\Controllers\CorController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/produto',[ProdutoController::class, 'index']);
Route::get('/produto/{produto}',[ProdutoController::class, 'show']);
Route::post('/produto',[ProdutoController::class, 'create']);
Route::put('/produto/{produto}',[ProdutoController::class, 'update']);
Route::delete('/produto/{produto}',[ProdutoController::class, 'destroy']);






Route::get('/cor',[CorController::class, 'index']);
Route::get('/cor/{cor}',[CorController::class, 'show']);
Route::post('/cor',[CorController::class, 'create']);
Route::put('/cor/{cor}',[CorController::class, 'update']);
Route::delete('/cor/{cor}',[CorController::class, 'destroy']);
