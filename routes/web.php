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

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('show');
})->name('users.home');


Route::get('/search', 'UserManagement@index')->name('search.action');

Route::get('/add', function () {
    return view('add_users');
})->name('users.add');


Route::get('/{id}', 'UserManagement@edit')->name('users.edit');
Route::get('delete/{id}','UserManagement@destroy')->name('users.delete');
//Route::put('/{id}', 'UserManagement@update')->name('users.update');
