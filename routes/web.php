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


Route::group(['middleware' => ['web']], function(){

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

$this->get('logout', 'Auth\LoginController@logout');
//data-arsip
Route::resource('arsip', 'DataArsipController');
Route::get('arsip/{id}/show', 'DataArsipController@show');
Route::get('dataarsip', 'DataArsipController@listData')->name('dataarsip');

});