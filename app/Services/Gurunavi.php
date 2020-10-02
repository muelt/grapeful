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
                  
                  'keyid' => '5e848f2b1e9a1b9982c1da30221c745f',//.envで設定したアクセスキー
                  'hit_per_page' => 100,
                  'freeword' => str_replace(' ', ',', $word),// 引数で渡ってきた(ユーザーが入力した)$wordを加工(半角スペースあればカンマに変換)
              ],
              'http_errors' => false,
          ]);
          
      // レスポンスボディに取得された全ての店舗情報が入ってくるのでそれを返す(JSON形式なので連想配列に変換しておく)    
      return json_decode($response->getBody()->getContents(), true);
    }
}