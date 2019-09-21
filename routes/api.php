<?php

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login', 'UserController@login');
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@userProfile');


});
Route::post('logout', 'UserController@logout');
Route::resource('users','UserManagement');
Route::get('/roles', 'UserManagement@getRoles');
Route::get('/permissions', 'UserManagement@getPermissions');

//List all the post
Route::get('/posts', 'PostController@index');

//List a single post
Route::get('/post/{id}', 'PostController@show');

//Create new post
Route::post('post/create', 'PostController@store');

//Update post
Route::put('post/update', 'PostController@store');

//Delete post
Route::delete('post/{id}', 'PostController@destroy');
