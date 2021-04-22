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



Route::redirect('/', '/login');

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home');

//====Shp
Route::get('shp', 'ShpController@index')->name('shp');
Route::post('shp/store', 'ShpController@store')->name('shp.store');

//====>SUPPORT
Route::get('support', 'SupportController@index')->name('support');
//---alias
Route::get('support/alias', 'SupportController@alias')->name('support.alias');
Route::post('support/alias/store', 'SupportController@storeAlias')->name('alias.store');
Route::get('support/alias/edit/{id}', 'SupportController@editAlias');
Route::post('support/alias/update', 'SupportController@updateAlias')->name('alias.update');
Route::delete('support/alias/destroy/{id}', 'SupportController@destroyAlias');
//---rencana
Route::get('support/rencana', 'SupportController@rencana')->name('support.rencana');
Route::post('support/rencana/store', 'SupportController@storeRencana')->name('rencana.store');
Route::get('support/rencana/edit/{id}', 'SupportController@editRencana');
Route::post('support/rencana/update', 'SupportController@updateRencana')->name('rencana.update');
Route::delete('support/rencana/destroy/{id}', 'SupportController@destroyRencana');

//====>User
Route::get('user', 'UserController@index')->name('user');
Route::post('user/store', 'UserController@store')->name('user.store');
Route::get('user/edit/{id}', 'UserController@edit');
Route::post('user/update', 'UserController@update')->name('user.update');
Route::delete('user/destroy/{id}', 'UserController@destroy');
