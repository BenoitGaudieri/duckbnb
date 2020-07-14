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
// Guest
Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@index')->name('search');
// TODO: TESTARE LA SHOW
Route::get('apartments/{apartment}', 'ApartmentController@show')->name('show');

Route::get('/sendmessage', 'SendMessageController@index');
Route::post('/sendmessage/send', 'SendMessageController@send');

Auth::routes();

// User
Route::prefix('user')
    ->name('user.')
    ->namespace('User')
    ->middleware('auth')
    ->group(function () {
        // Route::get('/dashboard', 'HomeController@index')->name('dashboard');
        Route::resource('apartments', 'ApartmentController');
    });
