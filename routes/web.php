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
    Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('update/{id}', 'UserController@update')->name('users.update');
    
});

// %php artisan ui bootstrap --authで生成された。この1行によって、最終的にvendor/laravel/framework/src/Illuminate/Routing/Router.phpの以下のメソッドが呼ばれている(ログイン、ログアウト、登録、パスワードリセットなどの記載)
Auth::routes();

Route::get('/', function () {
    return view('top');
})->name('top');

Route::get('/home', 'HomeController@index')->name('index');

Route::group(['middleware' => 'auth'], function(){
Route::get('/matching', 'MatchingController@index')->name('matching');
});

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function(){
    Route::post('show', 'ChatController@show')->name('chat.show');
    Route::post('chat', 'ChatController@chat')->name('chat.chat');
});

Route::get('/restaurants/gurunavi', 'RestaurantsController@gurunavi');

Route::post('/restaurants/search', 'RestaurantsController@search')->name('restaurant');

// Route::get('/restaurant', 'RestaurantsController@index');




