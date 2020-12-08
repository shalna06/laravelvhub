<?php
use Illuminate\Support\Facades\Auth;
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

Route::get('view', 'RegisterController@view')->name('view');
Route::get('login', 'RegisterController@login')->name('login'); 
Route::post('doregister','RegisterController@doregister')->name('doregister');
Route::post('logincheck','RegisterController@logincheck')->name('logincheck'); 
Route::get('fav','RegisterController@fav')->name('fav');
Route::post('addvideo','RegisterController@addvideo')->name('addvideo'); 
Route::get('logout','RegisterController@logout')->name('logout'); 
Route::get('deleted/{id}', 'RegisterController@deleted')->name('deleted'); 
Route::post('edited/{id}', 'RegisterController@edited')->name('edited');
