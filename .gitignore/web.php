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

Route::resource('almacen/categoria', 'CategoriaController');
Route::patch('almacen/categoria/{id}', [
    'as'   => 'almacen.categoria.update',
    'uses' => 'CategoriaController@update',
]);
Route::resource('almacen/color', 'ColorController');
Route::patch('almacen/color/{id}', [
    'as'   => 'almacen.color.update',
    'uses' => 'ColorController@update',
]);
Route::resource('almacen/talla', 'TallaController');
Route::patch('almacen/talla/{id}', [
    'as'   => 'almacen.talla.update',
    'uses' => 'TallaController@update',
]);

Route::resource('almacen/producto', 'ProductoController');
Route::patch('almacen/producto/{id}', [
    'as'   => 'almacen.producto.update',
    'uses' => 'ProductoController@update',
]);
Route::post('/crear', 'ProductoController@store');
