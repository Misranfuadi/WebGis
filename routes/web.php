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


Route::get('/shp', 'ShpController@index');

// Route::get('/', function () {
//     return view('contents.home');
// });
Route::redirect('/', '/login');

Auth::routes();
Auth::routes(['verify' => true]);
// Route::get('/email', 'Auth\VerificationController@show');

// Route::post('/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Route::post('/verify', 'Auth\VerificationController@verify')->name('verification.verify');

Route::get('/home','HomeController@index')->name('home');
