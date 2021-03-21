<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register routes for your application's admin. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

// setup language url

Route::get('locale/{locale}', function ($locale){
    //Session::put('locale', $locale);
    App::setlocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});


Auth::routes();

//if and only if admin is authenticated
// admin:admin ====> middleware:guard
Route::group(['middleware' => 'admin:admin'], function(){
	Route::view('/', 'admin.home')->name('home');
	Route::view('admins', 'admin.admins')->name('admins');
	Route::view('users', 'admin.users')->name('users');
	Route::view('banks', 'admin.banks')->name('banks');
	Route::view('categories', 'admin.categories')->name('categories');
	Route::view('products', 'admin.products')->name('products');
	Route::view('markets', 'admin.markets')->name('markets');
	Route::view('orders', 'admin.orders')->name('orders');
	Route::view('settings', 'admin.settings')->name('settings');
});
