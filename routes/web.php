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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('verify/{email}/{verify_token}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::resource('admin/category', 'Admins\CategoryController');
Route::get('admin/vueCategory', 'Admins\CategoryController@showVueCategory')->name('indexCategory');
Route::get('admin/getAllCategory', 'Admins\CategoryController@getAllCategory');

Route::get('admin', function(){
	return view('admin.master');
});

Route::resource('admin/products', 'Admins\ProductController');
Route::get('admin/vueProducts', 'Admins\ProductController@showVueProduct')->name('indexProducts');

Route::resource('admin/colors', 'Admins\ColorController');
Route::get('admin/vueColors', 'Admins\ColorController@showVueColor')->name('indexColors');


Route::resource('admin/sizes', 'Admins\SizeController');
Route::get('admin/vueSize', 'Admins\SizeController@showVueSize')->name('indexSizes');

