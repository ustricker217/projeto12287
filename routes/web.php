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





//ADMIN WEB ROUTES (VIEW)
Route::get('/admin','UserController@index')->name('user.index');
Route::get('/users/{id}', 'UserController@show');
Route::get('/images', 'ImageController@index')->name('image.index');
Route::get('/changeAdminPasswd', 'UserController@showChangePasswd')->name('admin.changePasswd');
Route::get('/changeConfigMail', 'UserController@showChangeConfigMail')->name('admin.updateConfigMail');

Route::get('/','VueController@index');
