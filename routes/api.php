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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

     
Route::post('auth/login', 'App\Http\Controllers\AuthController@login');


Route::group([
    //'middleware' => ['api','auth:api','role:UsuarioAPI'],
    'middleware' => ['api','role:UsuarioAPI'],
    'prefix' => 'auth'

], function ($router) {
   
    Route::get('me', 'App\Http\Controllers\AuthController@me');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('getDispoHotels','App\Http\Controllers\PreciosCupoReleaseController@getDispoHotels');
    Route::get('getHotelInfo/{id}', 'App\Http\Controllers\HotelController@show');
    Route::post('getDispoTraslados','App\Http\Controllers\TrasladosContratoCupoController@getDispoTraslados');
    Route::post('getDispoTours','App\Http\Controllers\ToursContratoCupoController@getDispoTour');
    Route::get('getTourInfo/{id}', 'App\Http\Controllers\TourController@show');
    Route::get('getFotoPrincipalTour','App\Http\Controllers\TourController@getFotoPrincipalTour');
    Route::post('crearcliente','App\Http\Controllers\WebServiceController@CreateCliente');
    Route::post('selectcliente','App\Http\Controllers\WebServiceController@SelectCliente');
    Route::get('getListaReservasByDate','App\Http\Controllers\ReservaController@getListaReservasByDate');
    Route::get('getListaReservasByName','App\Http\Controllers\ReservaController@getListaReservasByName');
    Route::get('getReservaByLocalizador','App\Http\Controllers\ReservaController@getReservaByLocalizador');
    Route::get('getDetailReserva','App\Http\Controllers\ReservaController@getDetailReserva');
    Route::post('addCarrito','App\Http\Controllers\CarritoComprasItemController@AddCarrito');
    Route::post('confirmReserva','App\Http\Controllers\ReservaController@confirmReserva');
    Route::get('showCarrito','App\Http\Controllers\CarritoComprasItemController@showCarrito');
    Route::delete('vaciarCarrito','App\Http\Controllers\CarritoComprasItemController@vaciarCarrito');
    Route::get('getFotoPrincipalMovilidad','App\Http\Controllers\TipoMovilidadeController@getFotoPrincipalMovilidad');
    Route::delete('vaciarRegistroCarrito', 'App\Http\Controllers\CarritoComprasItemController@destroy_si_paso_el_tiempo');
    Route::post('vaciarCarritoVencido', 'App\Http\Controllers\CarritoComprasItemController@vaciaCarritoVencido');
    Route::get('detalleReservaPenalidad/{id}', 'App\Http\Controllers\DetalleReservaController@calcularPenalidad');
    Route::get('cancelarDetalleReserva/{id}', 'App\Http\Controllers\DetalleReservaController@cancelar');
    
    //Voucher
    Route::get('voucher', 'App\Http\Controllers\ReservaController@voucher');
    

});