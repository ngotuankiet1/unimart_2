<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('users/home');
// });

Auth::routes(['verify' => true]);

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('admin', 'DashboardController@show');

    // ==================USERS===========================
    Route::get('admin/user/list', 'AdminUserController@show');
    Route::get('admin/user/add', 'AdminUserController@add');
    Route::post('admin/user/store', 'AdminUserController@store');
    Route::get('admin/user/search', 'AdminUserController@search')->name("ajaxUser.search");
    Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name("admin-delete");
    Route::get('admin/user/action', 'AdminUserController@action');
    Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('user.edit');
    Route::get('admin/user/edit/{id}', 'AdminUserController@edit');

    // ==================PRODUCTS===========================
    #PRODUCT
    Route::get('admin/product/list', 'AdminProductController@show');
    Route::get('admin/product/add', 'AdminProductController@add');
    Route::post('admin/product/store', 'AdminProductController@store')->name('product.store');
    Route::get('admin/product/delete/{id}', 'AdminProductController@delete')->name('product.delete');
    Route::post('admin/product/action', 'AdminProductController@action')->name('product.action');
    Route::get('admin/product/edit/{id}', 'AdminProductController@edit')->name('product.edit');
    Route::post('admin/product/update/{id}', 'AdminProductController@update')->name('product.update');
    #CAT
    Route::get('admin/product/cat/list', 'AdminProductController@show_cat');
    Route::post('admin/product/cat/store', 'AdminProductController@store_cat')->name('store.product.cat');
    Route::get('admin/product/cat/delete/{id}', 'AdminProductController@delete_cat')->name('delete.product.cat');
    Route::get('admin/product/cat/edit/{id}', 'AdminProductController@edit_cat');
    Route::post('admin/product/cat/update/{id}', 'AdminProductController@update_cat')->name('update_product_cat');

    // ==================POSTS===========================
    #POST
    Route::get('admin/post/list', 'AdminPostController@show');
    Route::get('admin/post/add', 'AdminPostController@add');
    Route::post('admin/post/store', 'AdminPostController@store')->name('post.store');
    Route::post('admin/post/action', 'AdminPostController@action')->name('post.action');
    Route::get('admin/post/delete/{id}', 'AdminPostController@delete')->name('post.delete');
    Route::get('admin/post/edit/{id}', 'AdminPostController@edit')->name('post.edit');
    Route::post('admin/post/update/{id}', 'AdminPostController@update')->name('post.update');
    #CAT
    Route::get('admin/post/cat/list', 'AdminPostController@show_cat');
    Route::post('admin/post/cat/store', 'AdminPostController@store_cat')->name('store.cat');
    Route::get('admin/post/cat/delete/{id}', 'AdminPostController@delete_cat')->name('delete.post.cat');
    Route::get('admin/post/cat/edit/{id}', 'AdminPostController@edit_cat');
    Route::post('admin/post/cat/update/{id}', 'AdminPostController@update_cat')->name('update.post.cat');
    // ==================PAGES===========================
    #PAGE
    Route::get('admin/page/list', 'AdminPageController@show');
    Route::get('admin/page/add', 'AdminPageController@add');
    Route::post('admin/page/store', 'AdminPageController@store')->name('page.store');
    Route::post('admin/page/action', 'AdminPageController@action')->name('page.action');
    Route::get('admin/page/delete/{id}', 'AdminPageController@delete')->name('page.delete');
    Route::get('admin/page/edit/{id}', 'AdminPageController@edit')->name('page.edit');
    Route::post('admin/page/update/{id}', 'AdminPageController@update')->name('page.update');
});


#USER
Route::group(['namespace' => 'User'], function () {
    Route::get('danh-muc-san-pham-{id}.html', 'UserProductController@categoty')->name('user.catrgory');
    Route::get('chi-tiet-san-pham-{id}.html', 'UserProductController@product_detail')->name('user.detail.product');
    Route::get('checkout','UserCartController@checkout')->name('cart.checkout');
    Route::get('login','UserCheckoutController@checkoutLogin')->name('cart.checkoutLogin');
    Route::get('logout','UserCheckoutController@checkLogout')->name('cart.checkoutLogout');
    Route::post('customer-add','UserCheckoutController@add_customer')->name('user.add');


    Route::group(['prefix' => 'cart'], function () {
        Route::get('/','UserCartController@show')->name('cart.show');
        Route::post('addCart-{id}','UserCartController@addCart')->name('cart.add');
        Route::get('delete-{rowId}','UserCartController@delete')->name('cart.delete');
        Route::post('update','UserCartController@updateCart')->name('cart.update');
    });
});




