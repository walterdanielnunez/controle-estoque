<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Produto;

//Home
Route::get('/', [HomeController::class, 'index']);

//Produtos
Route::get('/produtos', [Produto::class, 'index']);
Route::get('/produtos/novo', [Produto::class, 'novo']);
Route::post('/produtos/novo', [Produto::class, 'add']);
Route::post('/produtos/editar/{id}', [Produto::class, 'update']);
Route::get('/produtos/editar/{id}', [Produto::class, 'editar']);
Route::get('/produtos/estoque-baixo', [Produto::class, 'estoqueBaixo']);
Route::get('/produtos/movimentacao/{id}', [Produto::class, 'movimentacao']);
Route::post('/produtos/movimentacao/{id}', [Produto::class, 'setMovimentacao']);
Route::get('/produtos/movimentacoes', [Produto::class, 'movimentacoes']);


