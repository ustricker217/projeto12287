<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//ADMIN API ROUTES
Route::apiResource('users', 'UserControllerAPI');
Route::apiResource('images', 'ImageControllerAPI');

Route::put('users/{id}/changePermission', 'UserControllerAPI@blockUser');
Route::put('images/{id}/changeStatus', 'ImageControllerAPI@changeStatus');

Route::put('changeAdminPasswd', 'UserControllerAPI@updateAdminPassword');
Route::put('changeConfigMail', 'UserControllerAPI@updateConfigMail');

//PASSPORT API ROUTES
Route::post('login', 'LoginControllerAPI@login');
Route::middleware('auth:api')->post('logout', 'LoginControllerAPI@logout');


//GAME ROUTES
Route::get('newSinglePlayer', 'GameControllerAPI@createSinglePlayerGame');

//USER ROUTES
Route::get('userStatistics/{id}', 'UserControllerAPI@getStatistics');

Route::post('register', 'UserControllerAPI@create');

Route::get('getLoggedUser/{email}', 'UserControllerAPI@getLoggedUser');