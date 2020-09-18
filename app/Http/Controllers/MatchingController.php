<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Like;
use App\User;
use Auth;

use App\Constants\Status;
use Log;

class MatchingController extends Controller
{
    public static function index(){

        // まず自分にいいねしてくれた人のIDを取得
        $got_like_ids = Like::where([
            ['to_user_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('from_user_id');//pluckでID情報のみ取得できる
        Log::debug('$got_like_ids→自分にいいねしてくれた人のID');
        Log::debug($got_like_ids);

        // いいねしてくれた人の中から、自分がいいねした人のIDのみ取得
        // いいねしてくれた人のidだけを検索しつつ、自分(この場合はfrom_user_id)がいいねしている人を取得し、再度IDを取得する
        $matching_ids = Like::whereIn('to_user_id', $got_like_ids)->where('status', Status::LIKE)
        ->where('from_user_id', Auth::id())
        ->pluck('to_user_id');
        Log::debug('$matching_ids->いいねしてくれた人の中で自分もいいねした人のID');
        Log::debug($matching_ids);

        $matching_users = User::whereIn('id', $matching_ids)->get();
        Log::debug('$matching_users->お互いいにいいねした人の情報');
        Log::debug($matching_users);

        $match_users_count = count($matching_users);
        Log::debug('$matching_users_count->マッチングした人の数');
        Log::debug($match_users_count);

        return view('users.index', compact('matching_users', 'match_users_count'));
    }


    // 自分がいいねした人のIDを取得
    public function from_me(){
        $send_like_ids = Like::where([
            ['from_user_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('to_user_id');//pluckでID情報のみ取得できる
        Log::debug('$send_like_ids→自分がいいねした人のID');
        Log::debug($send_like_ids);

        $from_me_users = User::whereIn('id', $send_like_ids)->get();
        Log::debug('$from_users_users->自分がいいねした人の情報');
        Log::debug($from_me_users);
        // dd($from_me_users);

        $from_me_users_count = count($send_like_ids);
        Log::debug('$from_me_users_count->マッチングした人の数');
        Log::debug($from_me_users_count);

        return view('users.from_me', compact('from_me_users', 'from_me_users_count'));

    }

    //いいねしてくれた人のIDを取得
    public function from_users(){
        $got_like_ids = Like::where([
            ['to_user_id', Auth::id()],
            ['status', Status::LIKE]
        ])->pluck('from_user_id');//pluckでID情報のみ取得できる
        Log::debug('$got_like_ids→いいねしてくれた人のID');
        Log::debug($got_like_ids);

        $from_users = User::whereIn('id', $got_like_ids)->get();
        Log::debug('$from_users->いいねしてくれた人の情報');
        Log::debug($from_users);
        // dd($from_me_users);

        $from_users_count = count($got_like_ids);
        Log::debug('$from_users_count->マッチングした人の数');
        Log::debug($from_users_count);

        return view('users.from_users', compact('from_users', 'from_users_count'));


    }
}
