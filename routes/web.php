<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/info-hotel', 'Hotel\InfoHotelController');
Route::resource('admin/sucursales', 'Sucursal\SucursalesController');
Route::resource('admin/habitaciones', 'Habitacion\HabitacionesController');
Route::resource('admin/reservaciones', 'Reservacion\ReservacionesController');
Route::resource('admin/clientes', 'Cliente\ClientesController');
Route::get('info-hote/obtener-sucursales/{id_hotel}', 'Sucursal\SucursalesController@obtenerSucursales');
Route::get('sucursal/obtener-habitaciones/{id_hotel}', 'Habitacion\HabitacionesController@obtenerHabitaciones');
Route::get('reservacion/validarCliente/{numeroDocumento}', 'Cliente\ClientesController@obtenerCliente');
Route::post('admin/reservaciones/checkin/{id_reservacion}', 'Reservacion\ReservacionesController@checkIn');
Route::post('admin/reservaciones/pagoOnCheckOut', 'Reservacion\ReservacionesController@pagoOnCheckOut');
Route::get('admin/reservaciones/checkout/{id_reservacion}', 'Reservacion\ReservacionesController@checkOut');
Route::get('admin/reservaciones/validarPagoReserva/{id_reservacion}', 'Reservacion\ReservacionesController@validarPagoReserva');
Route::post('admin/reservaciones/calificacion', 'Reservacion\ReservacionesController@calificarReserva');
