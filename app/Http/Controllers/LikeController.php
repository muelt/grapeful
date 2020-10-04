<?php

// AjaxでPOST通信を受け取った後、データベースに情報を保存できるようにこのLikeコントローラを作成する

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Like;
use App\Constants\Status;// 好き嫌いを定数を設定しているファイル
use Log;

// class LikeController extends Controller
// {
//     public function create(Request $request){
//       dd($request);
//       Log::debug($request);//Post通信で渡ってきた内容をログに出力するように(wine-match/storage/logs/laravel.logで確認できる)
//       Log::debug('$requestの中身は下記の通り');
//       // Log::debug($request->from_user_id);
//       // Log::debug($request->to_user_id);
//       // Log::debug($request->like);
      
//       $to_user_id = $request->to_user_id;
//       $like_status = $request->like;
//       $from_user_id = $request->from_user_id;

//       if($like_status === 'like'){
//         $status = Status::LIKE;
//       }else{
//         $status = Status::DISLIKE;
//       }

//       // POST通信で渡ってきたto_user_idとfrom_user_idの組み合わせがあるか確認して、3つの情報をDBに保存する
//       $checkLike = Like::where([
//         ['to_user_id', $request->to_user_id],
//         ['from_user_id', $request->from_user_id],
//       ])->get();

//       if($checkLike->isEmpty()){
//         $like = new Like();

//         $like->to_user_id = $request->to_user_id;
//         $like->from_user_id = $request->from_user_id;
//         $like->status = $status;

//         $like->save();
//       }
//     }
// }


class LikeController extends Controller
{
    // Log::debug('likeコントローラーにきてるよ');
     // ここから追加
     public function create(Request $request)
     {
         Log::debug('likeコントローラーにきてるよ');

         $to_user_id = $request->to_user_id;
         $like_status = $request->like;
         $from_user_id = $request->from_user_id;
         Log::debug($to_user_id);
         Log::debug($like_status);
         Log::debug($from_user_id);

         if ($like_status === 'like'){
             $status = Status::LIKE;
         }else{
             $status = Status::DISLIKE;
         }
 
         $checkLike = Like::where([
         ['to_user_id', $to_user_id],
         ['from_user_id', $from_user_id],
         ['status', 0],
         ])->get();

         Log::debug($checkLike);
 
         if($checkLike->isEmpty()){
             
             $Like = new Like();
 
             $Like->to_user_id = $to_user_id;
             $Like->from_user_id = $from_user_id; 
             $Like->status = $status;
             Log::debug($Like);
             $Like->save();
         }
     }
     // ここまで追加
}



// home画面で likeかdislikeが選択されたら、
// Ajax通信で(画面切り替わりなしで) /api/like にアクセス
// ルーティングファイルに記載あるLikeコントローラーのcreateメソッドを呼び出す
// Likeコントローラのcreateメソッドでデータを保存する