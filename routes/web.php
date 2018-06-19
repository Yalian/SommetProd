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

Route::get('/inventario', function () {
    return redirect()->route('stock.index');
});

Route::prefix('inventario')->group(function () {

    // Materials
    Route::resource('materiales', 'Inventory\MaterialController')->except(['destroy', 'show'])->names([
        'create' => 'material.create',
        'store' => 'material.store',
        'index' => 'material.index',
        'update' => 'material.update',
        'edit' => 'material.edit'
    ]);
    Route::get('materiales/datos', 'Inventory\MaterialController@data')->name('material.data');

    // Orders
    Route::get('facturas/datos', 'Inventory\OrderController@data')->name('order.data');
    Route::resource('facturas', 'Inventory\OrderController')->except(['destroy', 'edit', 'update'])->names([
        'create' => 'order.create',
        'store' => 'order.store',
        'index' => 'order.index',
        'show' => 'order.show'
    ]);

    // Stock
    Route::get('bodega', 'Inventory\StockController@index')->name('stock.index');
    Route::get('bodega/datos', 'Inventory\StockController@data')->name('stock.data');


});


