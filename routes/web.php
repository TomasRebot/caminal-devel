<?php
//URL::forceScheme('https');
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
    return view('layouts.app');
})->middleware('auth');

Route::get('/logaut', function(){
Auth::logout();
return redirect('/');
});
Show::routes(dirname(__FILE__)."/routes");

// Route::group(['prefix' => 'administracion' , 'middleware' => [/*'auth' , 'check.ajax'*/]], function () {

// 	Route::resource('medicamentos', 'MedicamentosController')->names([
// 	    'index' 	=> 'show.all.medicamento',
// 	    'create' 	=> 'medicamento.create',
// 	    'store' 	=> 'medicamento.store',
// 	    'show'  	=> 'medicamento.show',
// 	    'destroy' 	=> 'medicamento.deshabilitar'
// 	]);

// 	Route::resource('stock' , 'StockController')->names([
// 	    'store' 	=> 'stock.store',
// 	]);

// 	Route::resource('clientes' , 'ClientesController')->names([
// 	    'index' 	=> 'show.all.clientes',
// 	]);

// 	Route::resource('movimientos', 'MovimientosController')->names([
// 	    'index' 	=> 'show.all.movimientos',
// 	    'create' 	=> 'movimientos.create',
// 	    'show'  	=> 'movimientos.detalles.show',
// 	    'destroy' 	=> 'movimientos.deshabilitar'
// 	]);
// });
