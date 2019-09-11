<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('admin.produtos.index');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'configs-app']], function () {
    Route::get('/', function () {
        return redirect()->route('admin.produtos.index');
    });

    Route::get('/produtos', 'Admin\ProdutosController@index')->name('admin.produtos.index');
    Route::get('/produtos/registro', 'Admin\ProdutosController@registro')->name('admin.produtos.registro');
    Route::get('/produtos/{id}', 'Admin\ProdutosController@edicao')->name('admin.produtos.edicao')->where(['id' => '[0-9]+']);
    Route::get('/produtos/visualizar/{id}', 'Admin\ProdutosController@visualizar')->name('admin.produtos.visualizar')->where(['id' => '[0-9]+']);
    Route::delete('/produtos/{id}', 'Admin\ProdutosController@delete')->name('admin.produtos.delete')->where(['id' => '[0-9]+']);
    Route::post('/produtos/save', 'Admin\ProdutosController@save')->name('admin.produtos.save');
    Route::post('/produtos/upload', 'Admin\ProdutosController@upload')->name('admin.produtos.upload');
});
