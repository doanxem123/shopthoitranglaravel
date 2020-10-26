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
Route::get('/add-category-product','CategoryProductController@add_category_product' );
Route::get('/all-category-product','CategoryProductController@all_category_product' );

//Brand Product
Route::get('/add-brand-product','BrandProductController@add_brand_product' );
Route::get('/all-brand-product','BrandProductController@all_brand_product' );