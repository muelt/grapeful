<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Gurunavi;
use App\Restaurant;

class RestaurantsController extends Controller
{

    public function gurunavi(){
        return view('restaurants.gurunavi');
    }

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
          
            // $replyText .=
            //     $restaurant['name'] . "\n" .
            //     $restaurant['image_url']['shop_image1'] . "\n" .
            //     $restaurant['url'] . "\n" .
            //     $restaurant['tel'] . "\n" .
            //     $restaurant['address'] . "\n" .
            //     "\n";
            $array[] = [
              'name' => $restaurant['name'],
              'url' => $restaurant['url'],
              'image_url' => $restaurant['image_url']['shop_image1'],
              'tel' =>  $restaurant['tel'],
              'address' => $restaurant['address'],
            ];
          }

        // dd($array);
        return view('restaurants.search', compact('array', 'request'));
        
  }

  
 // ユーザーが店舗を選択し登録ボタンをおした際、その店舗データをDBに保存する処理
//  引数に選択した店舗名が入ってくるようにする
  public function save(Request $request){
    // Gurunaviクラスをインスタンス化
    $gurunavi = new Gurunavi();
    $gurunaviResponse = $gurunavi->searchRestaurants($request->name);

    $array = [];
    foreach($gurunaviResponse['rest'] as $restaurant) {
      // dd($gurunaviResponse['rest']);
      
        // $replyText .=
        //     $restaurant['name'] . "\n" .
        //     $restaurant['image_url']['shop_image1'] . "\n" .
        //     $restaurant['url'] . "\n" .
        //     $restaurant['tel'] . "\n" .
        //     $restaurant['address'] . "\n" .
        //     "\n";
        $array[] = [
          'name' => $restaurant['name'],
          'url' => $restaurant['url'],
          'image_url' => $restaurant['image_url']['shop_image1'],
          'tel' =>  $restaurant['tel'],
          'address' => $restaurant['address'],
        ];
      }

      // ぐるなびAPIで取得してきた情報は、DBには保存していない。
      // どうやってユーザーが選択した値と一致する情報(店舗)のみ取り出してDBへ保存するのか
      // if($restaurant['name'] == '京都 瓢斗 東急プラザ渋谷店'){
      //   $favorite = SELECT * FROM  WHERE '京都 瓢斗 東急プラザ渋谷店' == $restaurant['name'];
      // }

      // dd($favorite);



  }


}

