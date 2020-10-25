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
//frontend

Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index' );

//backend
Route::get('/admin','AdminController@index' );
Route::get('/dashboard','AdminController@showdashboard' );
Route::get('/logout','AdminController@logout' );
Route::post('/admin-dashboard','AdminController@dashboard' );

//Category Product
Route::get('/add-category-prodcut','CategoryProductController@add_category_product' );
Route::get('/all-category-prodcut','CategoryProductController@all_category_product' );
