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

Route::post('/add', 'WalletController@add');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {


    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@registration');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group([

    'prefix' => 'api'

], function () {
    Route::get('/show', 'WalletController@show');
    Route::post('/add', 'WalletController@add');
    Route::get('/type/{type}', 'WalletController@findByType');
    Route::get('/dates/{from}&{to}','WalletController@findByDates');
    Route::put('/update','WalletController@update');
    Route::delete('/delete','WalletController@delete');
});

