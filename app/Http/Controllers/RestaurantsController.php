<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Gurunavi;
use App\Restaurant;

use Illuminate\Support\Facades\DB;

class RestaurantsController extends Controller
{
  // 検索ページ
  public function gurunavi(){
      return view('restaurants.gurunavi');
  }

  // =====================================================================
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
          'open_time' => $restaurant['open_time'],
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
    // Gurunaviクラスをインスタンス化
    $gurunavi = new Gurunavi();
    $gurunaviResponse = $gurunavi->searchRestaurants($request->shop_name);

    $param = [];
    // dd($request->register_shop);
    foreach($gurunaviResponse['rest'] as $restaurant) {
      if(in_array($restaurant['tel'], $request->register_shop)){
      $param = [
        'shop_name' => $restaurant['name'],
        'url' => $restaurant['url'],
        'image_url' => $restaurant['image_url']['shop_image1'],
        'tel' =>  $restaurant['tel'],
        'address' => $restaurant['address'],
        'access' => $restaurant['access'],
        'open_time' => $restaurant['opentime'],
        // 'close_time' => $restaurant['close_time'],
        'holiday' => $restaurant['holiday'],
        // 'category_name' => $restaurant['category_name'],
        ];
      }
      // dd($param);
      
      // 下記の記載だとArray to string conversionのエラーがでる

      DB::table('restaurants')->insert($param);
      // ユーザーが選択した１店舗のみをデータベースに保存したい
      DB::insert('insert into restaurants (shop_name, url, image_url, tel, address, access, open_time, holiday) values (:shop_name, :url, :image_url, :tel, :address, :access, :open_time, :holiday)', $param);
    }

    return redirect('/home');

  }

}

