<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('condtionse',function(){
return '';
});
Route::post('register', [ App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('canRest', [ App\Http\Controllers\Api\AuthController::class, 'canRest']);

Route::post('login',[ App\Http\Controllers\Api\AuthController::class,'login']); // Register
Route::post('logout',[ App\Http\Controllers\Api\AuthController::class,'logout']); // Register my_wallet
/////////////helpers
Route::post('contact_us', [ App\Http\Controllers\Api\HelperController::class,'contact_us']);
Route::post('like',[ App\Http\Controllers\Api\HelperController::class,'liketoggle']);
Route::post('payment',[ App\Http\Controllers\Api\HelperController::class,'payment']);
Route::post('my_wallet',[ App\Http\Controllers\Api\HelperController::class,'my_wallet']);

Route::get('banks',[ App\Http\Controllers\Api\HelperController::class,'banks']);
Route::get('sliders',[ App\Http\Controllers\Api\HelperController::class,'sliders']);
Route::get('get_shops',[ App\Http\Controllers\Api\HelperController::class,'get_shops']);

/*Route::post('follow', [ App\Http\Controllers\Api\HelperController::class,'follow'); product_search categories_search
*/Route::post('main_categories',[ App\Http\Controllers\Api\HelperController::class,'all_categories']);
Route::post('sub_categories',[ App\Http\Controllers\Api\HelperController::class,'sub_categories']);
Route::post('single_product',[ App\Http\Controllers\Api\HelperController::class,'single_product']);
Route::post('shopes_search',[ App\Http\Controllers\Api\HelperController::class,'shopes_search']);
Route::post('categories_search',[ App\Http\Controllers\Api\HelperController::class,'categories_search']);
Route::post('product_search',[ App\Http\Controllers\Api\HelperController::class,'product_search']);

Route::get('aboutUs', [ App\Http\Controllers\Api\HelperController::class,'aboutUs']);
Route::get('condtions',[ App\Http\Controllers\Api\HelperController::class,'condtions']);






/////update profile
Route::post('user_banner', [ App\Http\Controllers\Api\ProfileController::class,'user_banner']);//user_banner
Route::post('user_image', [ App\Http\Controllers\Api\ProfileController::class,'user_image']);//all_image
Route::post('update_profile', [ App\Http\Controllers\Api\ProfileController::class,'update_profile']);//all_image
/////chat
Route::post('all_rooms', [ App\Http\Controllers\Api\ChatController::class,'all_rooms']);//all_rooms
Route::post('single_room', [ App\Http\Controllers\Api\ChatController::class,'single_room']);//single_room
Route::post('send_message', [ App\Http\Controllers\Api\ChatController::class,'send_message']);//single_room
////order
Route::post('single_order', [ App\Http\Controllers\Api\OrderController::class,'single_order']);//single_room
Route::post('add_order', [ App\Http\Controllers\Api\OrderController::class,'add_order']);//single_room
Route::post('my_orders', [ App\Http\Controllers\Api\OrderController::class,'my_orders']);//single_room
Route::post('accept_order', [ App\Http\Controllers\Api\OrderController::class,'accept_order']);//single_room
Route::post('canceling_order', [ App\Http\Controllers\Api\OrderController::class,'canceling_order']);//single_room
Route::post('finshing_order', [ App\Http\Controllers\Api\OrderController::class,'finshing_order']);//single_room

Route::post('search', [ App\Http\Controllers\Api\NotificationController::class,'search']);//
Route::post('my_notification', [ App\Http\Controllers\Api\NotificationController::class,'my_notification']);//
Route::post('delete_notification', [ App\Http\Controllers\Api\NotificationController::class,'delete_my_notification']);
