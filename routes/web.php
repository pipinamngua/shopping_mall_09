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
Route::get('admin/products/addColors/{id}', 'Admins\ProductController@addColor');

Route::resource('admin/colors', 'Admins\ColorController');
Route::get('admin/vueColors', 'Admins\ColorController@showVueColor')->name('indexColors');
Route::get('admin/getAllColors', 'Admins\ColorController@getAllColors');


Route::resource('admin/sizes', 'Admins\SizeController');
Route::get('admin/vueSize', 'Admins\SizeController@showVueSize')->name('indexSizes');
Route::get('admin/getAllSizes', 'Admins\SizeController@getAllSizes');


Route::resource('admin/productAttributes', 'Admins\ProductAtributesController');
Route::get('admin/productAttributes/{id}/{color_id}', 'Admins\ProductAtributesController@getColorImages');
Route::post('admin/productAttributes/{id}/{color_id}', 'Admins\ProductAtributesController@delete');

Route::resource('admin/discountProgram', 'Admins\DiscountProgramController');
Route::get('admin/vueDiscountProgram', 'Admins\DiscountProgramController@showVueDiscountProgram')->name('discountProgram');

Route::resource('admin/discountProduct', 'Admins\DiscountProduct');
Route::get('admin/vueDiscountProduct', 'Admins\DiscountProduct@showVueDiscountProduct')->name('discount');
Route::get('admin/getAllProduct', 'Admins\DiscountProduct@getAllProduct');
Route::get('admin/getAllDiscountProgram', 'Admins\DiscountProduct@getAllDiscountProgram');


Route::middleware('admin')->group(function () {
    Route::resource('admin-users', 'Admins\UserController');
    Route::get('admin-list-user', [
        'as' => 'listuser',
        'uses' => 'Admins\UserController@getListUser'
    ]);
    Route::get('order', [
        'as' => 'order',
        'uses' => 'Admins\OrderController@getListOrder'
    ]);
    Route::get('order-detail/{id}', [
        'as' => 'orderdetail',
        'uses' => 'Admins\OrderDetailController@getListOrderDetail'
    ]);
    Route::get('update-status-order', [
        'as' => 'updatestatusorder',
        'uses' => 'Admins\OrderDetailController@getUpdateStatusOrder'
    ]);
});

Route::resource('customer/products','Customers\ProductController');
Route::get('customer/latest', 'Customers\ProductController@getLatestProduct');
Route::get('customer/All', 'Customers\ProductController@getAllProduct');
Route::get('customer/getDiscount/{id}', 'Customers\ProductController@getDiscount');
Route::get('customer/getAttribute/{id}', 'Customers\ProductController@getAttribute');
Route::get('customer/getColor/{id}/{colorId}', 'Customers\ProductController@getColor');
Route::get('customer/getRelatedProduct/{id}', 'Customers\ProductController@relatedProduct');

Route::get('category/{id}', [
    'as' => 'list-product',
    'uses' => 'Customers\ProductController@getListProductByCategory'
]);

Route::get('show-cart', [
    'as' => 'showcart',
    'uses' => 'CartController@getShowCart'
]);

Route::get('add-cart', [
    'as' => 'addcart',
    'uses' => 'CartController@getAddCart'
]);

Route::get('get-cart', [
    'as' => 'getcart',
    'uses' => 'CartController@getCart'
]);

Route::get('update-cart', [
    'as' => 'updatecart',
    'uses' => 'CartController@getUpdateCart'
]);

Route::get('del-cart', [
    'as' => 'deletecart',
    'uses' => 'CartController@getDeleteCart'
]);

Route::post('checkout', [
    'as' => 'checkout',
    'uses' => 'CheckoutController@postCheckout'
]);

Route::get('my-order/{id}', [
    'as' => 'myorder',
    'uses' => 'HomeController@getMyOrder'
]);

Route::get('my-order-detail/{id}', [
    'as' => 'myorderdetail',
    'uses' => 'HomeController@getMyOrderDetail'
]);

Route::get('delete-order/{id}',  [
    'as' => 'deleteorder',
    'uses' => 'HomeController@getDeleteOrder'
]);
