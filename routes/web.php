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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/admin', 'AdminController@index');

Route::resource('inventory', 'InventoryController');
Route::resource('category', 'CategoryController');
Route::resource('subcategory', 'SubCategoryController');
Route::resource('usersinfo', 'UsersInfoController');

Route::get ('order', 'OrderController@create');
Route::post ('order', 'OrderController@store');
