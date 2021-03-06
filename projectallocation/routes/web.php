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
    return view('welcome');
});
Auth::routes();

Route::resource('/users', 'UserController');

Route::resource('/projects', 'ProjectController');

Route::resource('/students', 'StudentController');

Route::get('/allocate', 'ProjectController@allocate')->name('allocate');

Route::get('/algorithm', 'ProjectController@algorithm')->name('algorithm');

Route::get('/allocations', 'ProjectController@allocations')->name('allocations');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
