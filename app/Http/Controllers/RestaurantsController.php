<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Services\Gurunavi;

class RestaurantsController extends Controller
{

    public function show(){
        return view('restaurants.show');
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
            $replyText .=
                $restaurant['name'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                $restaurant['url'] . "\n" .
                "\n";
            }   

        // dd($replyText);
        return view('restaurants.search', compact('replyText'));
        
    }

}

