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

// setup language url

// Route::get('locale/{locale}', function ($locale){
//     //Session::put('locale', $locale);
//     App::setlocale($locale);
//     session()->put('locale', $locale);
//     return redirect()->back();
// });


// Auth::routes();

// //if and only if admin is authenticated
// // admin:admins ====> middleware:guard
// Route::group(['middleware' => 'admin:admins'], function(){

// 	Route::view('/', 'admin.home')->name('home');

// 	Route::view('categories', 'admin.categories')->name('categories');

// 	Route::view('products', 'admin.products')->name('products');

// });
