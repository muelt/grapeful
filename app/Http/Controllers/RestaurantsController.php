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
        // getTextメソッドでユーザーからのメッセージのテキストを取り出す。検索結果の連想配列が$gurunaviResponseに入る
        // dd($request->freeword);
        $gurunaviResponse = $gurunavi->searchRestaurants($request->freeword);

        // ぐるなびAPIのレスポンスがエラーだった場合の処理
        // if (array_key_exists('error', $gurunaviResponse)) {
        //     $replyText = $gurunaviResponse['error'][0]['message'];
        //     $replyToken = $event->getReplyToken();
        //     $lineBot->replyText($replyToken, $replyText);
        //     continue;
        // }

        $replyText = '';
        foreach($gurunaviResponse['rest'] as $restaurant) {
          // dd($gurunaviResponse['rest']);
          
            $replyText .=
                $restaurant['name'] . "\n" .
                $restaurant['image_url']['shop_image1'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['tel'] . "\n" .
                $restaurant['address'] . "\n" .
                "\n";
      
     
          }

        // $replyTextは取得した全店舗のまとまったデータであるため、店舗1つ1つのまとまりとして抽出ができない。どうすれば良いか？
        dd($replyText);


        return view('restaurants.search', compact('replyText', 'request'));
        

  }
}

