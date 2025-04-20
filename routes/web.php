<?php

use App\Http\Controllers\ComprasController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\LicitacaoController;
use App\Http\Controllers\OutrosController;
use App\Http\Controllers\PrincipalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PrincipalController::class, 'index'])->name('principal');
Route::get('/dadosGerais', [PrincipalController::class, 'dadosGerais'])->name('geral');
Route::get('/compras', [ComprasController::class, 'index'])->name('compras');
Route::get('/licitacao', [LicitacaoController::class, 'index'])->name('licitacao');
Route::get('/contrato', [ContratoController::class, 'index'])->name('contrato');
Route::get('/outros', [OutrosController::class, 'index'])->name('outros');