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

// Route::groupの引数として'prefix' => 'users'という表記をすることで、Urlの先頭にusersを付与する
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function(){
    Route::get('show/{id}', 'UserController@show')->name('users.show');
    Route::get('show/{id}', 'UserController@show')->name('users.show');
    Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('update/{id}', 'UserController@update')->name('users.update');

    Route::get('register/{id}', 'UserController@register')->name('users.register');
    Route::post('register_update/{id}', 'UserController@register_update')->name('users.register_update');
    Route::get('register_shop/{id}', 'UserController@register_shop')->name('users.register_shop');
    Route::post('shop_update/{id}', 'UserController@shop_update')->name('users.shop_update');
    
});


Route::group(['middleware' => 'auth'], function(){
    Route::get('/matching', 'MatchingController@index')->name('matching');
    Route::get('/from_me', 'MatchingController@from_me')->name('from_me');
    Route::get('/from_users', 'MatchingController@from_users')->name('from_users');
});


Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function(){
    Route::post('show', 'ChatController@show')->name('chat.show');
    Route::post('chat', 'ChatController@chat')->name('chat.chat');
});


Route::get('/restaurants/gurunavi', 'RestaurantsController@gurunavi')->name('restaurants.gurunavi');

Route::get('/restaurants/search', 'RestaurantsController@search')->name('restaurant');
Route::post('/restaurants/save', 'RestaurantsController@save')->name('restaurant_save');

// Route::get('/restaurant', 'RestaurantsController@index');

// 最初に定義されるもの
Route::get('/', function () {
    return view('top');
})->name('top');

// %php artisan ui bootstrap --authで生成された。この1行によって、最終的にvendor/laravel/framework/src/Illuminate/Routing/Router.phpの以下のメソッドが呼ばれている(ログイン、ログアウト、登録、パスワードリセットなどの記載)
Auth::routes();

Route::get('/home', 'HomeController@index')->name('index');

Route::post('/home', 'HomeController@searched')->name('index_searched');

// ここまで
