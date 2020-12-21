<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# Cadastro de corredor
Route::post('corredor', 'CorredorController@cadastrar');

# Cadastro de prova
Route::post('prova', 'ProvaController@cadastrar');

# Cadastro de corrida e resultado
Route::post('corrida', 'CorridaController@cadastrar');
Route::post('corrida/{id}/resultado', 'CorridaController@cadastrarResultado');

# Relatório das corridas
Route::get('corrida/relatorio/geral', 'CorridaController@gerarRelatorioGeral');
Route::get('corrida/relatorio/idade', 'CorridaController@gerarRelatorioIdade');