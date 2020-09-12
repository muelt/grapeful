<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// api向けのルーティングファイル
// Ajax(非同期通信)でlike, dislike を取得したいため、web.phpではなく、api.phpにpost通信を追記する
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// このファイルにルーティングを記載すると自動的に/apiというURLが付与される。この場合、/api/like
Route::post('/like', 'LikeController@create');


// ぐるなびAPIを呼び出すためのルート
//このルートを書くことで"http://localhost:8000/api/restaurant"というエンドポイント(APIへの入り口)ができて、これを使用することでAPIを利用することができる
Route::get('/restaurant', 'RestaurantsController@getGnaviApi');

