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

Route::get('/', 'gitController@index') -> name('home');

Route::post('/', 'gitController@search') -> name('search');

Route::get('/{entity}/{search}/page_{page?}/{sort?}/{order?}', 'gitController@results') -> name('results');

