<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Gurunavi;
use App\Restaurant;
use Auth;
use App\User;


use Illuminate\Support\Facades\DB;

class RestaurantsController extends Controller
{
  // 検索ページ
  public function gurunavi(){
      return view('restaurants.gurunavi');
  }

  
  // ユーザーが入力した値を元にぐるなびAPIから店舗データを取得して表示させる処理
  public function search(Request $request){
    // Gurunaviクラスをインスタンス化
    $gurunavi = new Gurunavi();
    // $request->freewordでユーザーが入力したキーワードを取り出す。検索結果の連想配列が$gurunaviResponseに入る
    $gurunaviResponse = $gurunavi->searchRestaurants($request->freeword);

    // ぐるなびAPIのレスポンスがエラーだった場合の処理
    // if (array_key_exists('error', $gurunaviResponse)) {
    //     $replyText = $gurunaviResponse['error'][0]['message'];
    //     $replyToken = $event->getReplyToken();
    //     $lineBot->replyText($replyToken, $replyText);
    //     continue;
    // }

    $array = [];
    foreach($gurunaviResponse['rest'] as $restaurant) {
      // dd($gurunaviResponse['rest']);
      
        $array[] = [
          'shop_name' => $restaurant['name'],
          'url' => $restaurant['url'],
          'image_url' => $restaurant['image_url']['shop_image1'],
          'tel' =>  $restaurant['tel'],
          'address' => $restaurant['address'],
          'access' => $restaurant['access'],
          // 'open_time' => $restaurant['open_time'],
          // 'close_time' => $restaurant['close_time'],
          'holiday' => $restaurant['holiday'],
          // 'category_name' => $restaurant['category_name'],
        ];
      }

    // dd($array);
    return view('restaurants.search', compact('array', 'request'));    
}



  // ======ここからユーザーが選択した店舗を保存する@save======
 // ユーザーが店舗を選択し登録ボタンをおした際、その店舗データをDBに保存する処理
//  引数に選択した店舗名が入ってくるようにする
  public function save(Request $request){

    // 既にお店を登録済みの場合には、restaurantsテーブルから一旦削除する
    $user_id = DB::table('restaurants')->where('user_id', Auth::id())->get();
    // dd($user_id);
    if($user_id){
      DB::table('restaurants')->where('user_id', Auth::id())->delete();
    }

    // Gurunaviクラスをインスタンス化
    $gurunavi = new Gurunavi();
    $gurunaviResponse = $gurunavi->searchRestaurants($request->shop_name);

    $param = [];
    // 選択された最初の一つだけ取り出す
    // dd($request->register_shop[0]);
    $register_shop[] = $request->register_shop[0];
    foreach($gurunaviResponse['rest'] as $restaurant) {
      if(in_array($restaurant['tel'], $register_shop)){

      // []がないと連想配列になってしまうため、結果的に多重配列になり保存ができない。必ずつける
      $param[] = [
       // 配列になっているものもあるので注意
        'shop_name' => $restaurant['name'],
        'url' => $restaurant['url'],
        'image_url' => $restaurant['image_url']['shop_image1'],
        'tel' =>  $restaurant['tel'],
        'address' => $restaurant['address'],
        'access' => $restaurant['access']['station'],
        'open_time' => $restaurant['opentime'],
        // 'close_time' => $restaurant['close_time'],
        'holiday' => $restaurant['holiday'],
        // 'category_name' => $restaurant['category_name'],
        'user_id' => Auth::id(),
        ];
        // dd($param);
      }
      
    }

    // 下記の記載だとArray to string conversionのエラーがでる
    // user_idがnullだから？
  if(isset($param)){
    DB::table('restaurants')->insert($param);
  }

    // saveした店舗情報を変数に入れる（register.balde.phpで表示させるために）
    $restaurant = DB::getPdo()->lastInsertId();
    // dd($restaurant);
    // $restaurant_info = DB::select('select * from restaurants where id = (string)$restaurant');
    $restaurant_info = Restaurant::find((string)$restaurant);
    // dd($restaurant_info);
    $shop_name = $restaurant_info->shop_name;
    // dd($shop_name);
    $image_url = $restaurant_info->image_url;
    $url = $restaurant_info->url;
    // dd($param[0]->shop_name);

    // 登録画面に戻る(リダイレクトでないとだめ。viewに値を渡すにはどうすれば良いか)
    // return redirect()->route('users.register', ['id' => Auth::id()]);
    return redirect()->route('users.show', ['id' => Auth::id()]);

    
    // return view('users.register_add', compact('restaurant', 'shop_name', 'image_url', 'url', 'user'));

  }

}

