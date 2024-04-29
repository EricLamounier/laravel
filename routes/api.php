<?php

use App\Http\Controllers\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => ''], function (){
    Route::post('index', [Usuario::class, 'index']); // Cadastra um usuario
});

Route::group(['prefix' => ''], function (){
    Route::get('pegaContas/{id}', [Usuario::class, 'pegaContas']);
});

Route::group(['prefix' => ''], function (){
    Route::get('pegaTotalReceitaDespesa/{id}', [Usuario::class, 'pegaTotalReceitaDespesa']);
});

Route::group(['prefix' => ''], function (){
    Route::get('pegaUsuario/{uid}', [Usuario::class, 'pegaUsuario']);
});

Route::group(['prefix' => ''], function (){
    Route::put('atualizaTransacao/{id}', [Usuario::class, 'atualizaTransacao']);
});

Route::group(['prefix' => ''], function (){
    Route::post('adicionaTransacao/{id}', [Usuario::class, 'adicionaTransacao']);
});

Route::group(['prefix' => ''], function (){
    Route::delete('deletaTransacao/{id}', [Usuario::class, 'deletaTransacao']);
});

Route::group(['prefix' => ''], function (){
    Route::delete('deletaConta/{id}', [Usuario::class, 'deletaConta']);
});

Route::group(['prefix' => ''], function (){
    Route::post('adicionaConta/{id}', [Usuario::class, 'adicionaConta']);
});

Route::group(['prefix' => ''], function (){
    Route::get('teste', [Usuario::class, 'teste']);
});