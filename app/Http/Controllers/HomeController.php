<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
        // dd($userCount);
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
        $array[] = Auth::id();

        // 表示させるユーザーの数をカウント(自分自身といいね済以外)
        $countingSelected = collect($array)->count();
        $userCountSelected = $userCount - $countingSelected;
        
        // compactメソッドで複数の変数をビュー側(home.blade.php)へ渡す
        return view('home', compact('users', 'userCount', 'from_user_id', 'array',  'userCountSelected'));
    }



    // ここからsearched(キーワードでDB検索し表示させる)
    public function searched(Request $request)
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

        $array[] = $from_user_id;

        // ユーザーが入力したキーワードでDB検索
        // dd($request->input('freeword'));
        $freeword = $request->input('freeword');
        
        // 4つのカラムのなかでキーワードと一致するものあれば、ユーザー情報を取得する
        $users_selected = DB::table('users')
        ->whereNotIn('id', $array)
        ->where('type_of_wine', 'like', "%$freeword%")
        ->orWhere('verify_of_wine', 'like', "%$freeword%")
        ->orWhere('producing_area', 'like', "%$freeword%")
        ->orWhere('favorite_food', 'like', "%$freeword%")
        ->orWhere('sex', 'like', "%$freeword%")
        ->orWhere('age', 'like', "%$freeword%")
        ->orWhere('address', 'like', "%$freeword%")
        ->orWhere('self_introduction', 'like', "%$freeword%")
        ->orWhere('price_range', 'like', "%$freeword%")
        ->orWhere('married', 'like', "%$freeword%")
        ->orWhere('name', 'like', "%$freeword%")

        ->get();
        
        $userCountSelected = $users_selected->count();//キーワードに該当したユーザー
        // dd($userCountSelected);
        // dd($users);

        // 全てのユーザー($users)から検索されたキーワードに合致したユーザーのみで絞り込む
        // foreach($users_selected as $user_selected){
        //     $users_index[] = $users->where('id', $user_selected->id)->first();
        // }
        // dd($users);
        // dd($users_selected);
        // dd($array);

        // foreach($users_index as $user_index){
        //     dd($user_index);
        // }
        
        // compactメソッドで複数の変数をビュー側(home.blade.php)へ渡す
        return view('home_searched', compact('users_selected', 'userCount', 'from_user_id', 'array', 'userCountSelected'));
    }



    public function top(){
        return view('top');
    }
}
