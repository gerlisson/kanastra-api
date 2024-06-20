<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('historico', [\App\Http\Controllers\Api\HistoricoController::class, 'index']);
Route::post('upload-csv', [\App\Http\Controllers\Api\BoletoController::class, 'uploadCsv']);