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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth','verified')->group(function () {
    Route::get('dashboard', 'DashboardController@show');

    // ==================USERS===========================
    Route::get('admin/user/list', 'AdminUserController@show');
    Route::get('admin/user/add', 'AdminUserController@add');
    Route::post('admin/user/store', 'AdminUserController@store');
    Route::get('admin/user/search', 'AdminUserController@search')->name("ajaxUser.search");
    Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name("admin-delete");
    Route::get('admin/user/action', 'AdminUserController@action');
    Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('user.edit');
    Route::get('admin/user/edit/{id}', 'AdminUserController@edit');
});
