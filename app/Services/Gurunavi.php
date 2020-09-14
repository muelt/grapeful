<?php

namespace App\Services;

// ライブラリを使用
use GuzzleHttp\Client;

class Gurunavi
{

  // ぐるなびレストラン検索
  private const RESTAURANTS_SEARCH_API_URL = 'https://api.gnavi.co.jp/RestSearchAPI/v3/';

    public function searchRestaurants(string $word):array 
    {
      // GuzzleのClientインスタンスを生成
      $client = new Client();
      $response = $client
        ->get(self::RESTAURANTS_SEARCH_API_URL, [
              'query' => [
                  
                  'keyid' => env('GURUNAVI_ACCESS_KEY'),//.envで設定したアクセスキー
                  'freeword' => str_replace(' ', ',', $word),// 引数で渡ってきた(ユーザーが入力した)$wordを加工(半角スペースあればカンマに変換)
              ],
              'http_errors' => false,
          ]);
          
      // レスポンスボディに取得された全ての店舗情報が入ってくるのでそれを返す(JSON形式なので連想配列に変換しておく)    
      return json_decode($response->getBody()->getContents(), true);
    }
}