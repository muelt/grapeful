<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Like;
use App\Constants\Status;
use Auth;
use Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 認証済みであれば表示、認証していなければ/loginにリダイレクトされるようになっている
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    // Route::get('/home', 'HomeController@index')->name('home');でルーティング設定しているトップ画面
    public function index(Request $request)
    {
        // ユーザーの情報を全て取ってきて(Eloquent: User::all())、ビューファイルに渡す
        $users = User::all();


        $userCount = $users->count();//全ユーザーの数を取得
        $from_user_id = Auth::id();//現在ログインしているユーザーのIDを取得

        // 自分からすでにいいねをした人のidを取得して$arrayにいれる。Viewに渡す
        $send_like_ids = Like::where([
            ['from_user_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('to_user_id');//pluckでID情報のみ取得できる
        Log::debug('$send_like_ids→自分がいいねした人のID');
        Log::debug($send_like_ids);

        $from_users_users = User::whereIn('id', $send_like_ids)->get();
        $array = [];
        foreach($from_users_users as $from_users_user){
            $array[] = $from_users_user['id'];
        }

        // dd($request->input('type_of_wine'));
        $freeword = $request->input('type_of_wine');
        $users_selected = User::where('type_of_wine', 'like', '%$freeword%');
        $array[] = Auth::id();

        // dd($array);

        
        // compactメソッドで複数の変数をビュー側(home.blade.php)へ渡す
        return view('home', compact('users', 'userCount', 'from_user_id', 'array'));
    }

    // public function index(Request $request){

    //     dd($request->input('type_of_wine'));
    //     $freeword = $request->input('type_of_wine');
    //     $users_selected = User::where('type_of_wine', 'like', '%$freeword%');

    // }



    public function top(){
        return view('top');
    }
}
