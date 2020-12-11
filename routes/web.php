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
//--frontend--

//Home + Account
Route::get('/','HomeController@index' );
Route::get('/trang-chu','HomeController@index' );
Route::get('/login','HomeController@login');
Route::post('/check-login','HomeController@check_login');
Route::post('/sign-up','HomeController@sign_up');
Route::get('/settings','HomeController@settings');
Route::get('/logout','HomeController@logout');	
Route::post('/update-account','HomeController@update_account');

//Filter
Route::get('/show-filter-product/category={category_id}&brand={brand_id}','FilterController@show_filter_product' );
Route::post('/show-filter-product/category={category_id}&brand={brand_id}','FilterController@show_filter_product' );
Route::post('/show-filter-product/search={search_keywords}','FilterController@search_product' );
Route::get('/show-filter-product/search={search_keywords}','FilterController@search_product' );

//Product
Route::get('/product/id={product_id}','ProductController@details_product' );

//Cart
Route::get('/show-cart','CartController@show_cart' );
Route::post('/save-cart','CartController@save_cart');
Route::get('/update-cart/rowId={rowId}&qty={qty}','CartController@update_cart');
Route::post('/check-discount','CartController@check_discount');

//Checkout
Route::get('/show-checkout','CheckoutController@show_checkout');
Route::get('/finish-checkout','CheckoutController@finish_checkout');
Route::post('/send-checkout','CheckoutController@send_checkout');

//Invoice
Route::get('/invoice','InvoiceController@invoice');
Route::get('/details-invoice/id={invoice_id}','InvoiceController@details_invoice');
Route::get('/show-filter-invoice','InvoiceController@filter_invoice');
Route::post('/show-filter-invoice','InvoiceController@filter_invoice');
Route::get('/update-invoice/id={invoice_id}&status={send_status}','InvoiceController@update_invoice');
Route::post('/update-invoice/id={invoice_id}&status={send_status}','InvoiceController@update_invoice');
Route::post('/checkbox-ajax','InvoiceController@checkbox_ajax');


//--backend--
Route::get('/admin','AdminController@index' );
Route::get('/dashboard','AdminController@showdashboard' );
Route::get('/logoutAdmin','AdminController@logout' );
Route::post('/admin-dashboard','AdminController@dashboard' );

//Category Product
Route::get('/add-category-product','CategoryProductController@add_category_product' );
Route::get('/all-category-product','CategoryProductController@all_category_product' );
Route::post('/save-category-product','CategoryProductController@save_category_product');

//Brand Product
Route::get('/add-brand-product','BrandProductController@add_brand_product' );
Route::get('/all-brand-product','BrandProductController@all_brand_product' );

