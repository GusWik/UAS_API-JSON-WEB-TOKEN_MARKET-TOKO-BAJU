<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('password',function(){
    return bcrypt('idabagus');
});

Route::get('/pengguna', 'API\PenggunaController@index');
Route::get('/pengguna/{pengguna}', 'API\PenggunaController@show');
Route::delete('/pengguna/{pengguna}', 'API\PenggunaController@destroy');
Route::post('/pengguna/', 'API\PenggunaController@store');
Route::patch('/pengguna/{pengguna}', 'API\PenggunaController@update');

Route::get('/pembeli', 'API\PembeliController@index');
Route::get('/pembeli/{pengguna}', 'API\PembeliController@show');
Route::delete('/pembeli/{pengguna}', 'API\PembeliController@destroy');
Route::post('/pembeli/', 'API\PembeliController@store');
Route::patch('/pembeli/{pengguna}', 'API\PembeliController@update');

Route::get('/barang', 'API\BarangController@index');
Route::get('/barang/{barang}', 'API\BarangController@show');
Route::delete('/barang/{barang}', 'API\BarangController@destroy');
Route::post('/barang/', 'API\BarangController@store');
Route::patch('/barang/{barang}', 'API\BarangController@update');

Route::get('/penjualan', 'API\PenjualanController@index');
Route::get('/penjualan/{penjualan}', 'API\PenjualanController@show');
Route::delete('/penjualan/{penjualan}', 'API\PenjualanController@destroy');
Route::post('/penjualan/', 'API\PenjualanController@store');
Route::patch('/penjualan/{penjualan}', 'API\PenjualanController@update');


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    }
);
