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
    return view('admin.home');
});

Route::get('/inventario', function (){
    return redirect()->route('stock.index');
});

Route::prefix('inventario')->group(function () {

    // Materials

    Route::get('materiales', 'Inventory\MaterialController@index')->name('material.index');
    Route::get('materiales/datos', 'Inventory\MaterialController@data')->name('material.data');
    Route::get('materiales/crear', 'Inventory\MaterialController@create')->name('material.create');
    Route::post('materiales/guardar', 'Inventory\MaterialController@store')->name('material.store');
    Route::get('materiales/lista', 'Inventory\MaterialController@list')->name('material.list');


    // Orders

    Route::get('facturas', 'Inventory\OrderController@index')->name('order.index');
    Route::get('facturas/datos', 'Inventory\OrderController@data')->name('order.data');
    Route::get('facturas/create', 'Inventory\OrderController@create')->name('order.create');

    // Stock

    Route::get('bodega', 'Inventory\StockController@index')->name('stock.index');


});


