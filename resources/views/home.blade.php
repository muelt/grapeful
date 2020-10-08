@extends('layouts.layout')

@section('content')

<!-- ユーザーが入力したキーワードで絞り込み -->
<div class="topPage">
  <form class="searchBox" action="{{ route('index_searched') }}" method="POST">
    @csrf
    <input type="search" placeholder="プロフィールからキーワードでさがす(ワインのタイプ、年齢、都道府県、性別など)" class="searchText ac" name="freeword">
    <button class="btn" type="submit" name="button">
      <i class="fas fa-search" aria-hidden="true"></i>
    </button>
  </form>

  <div class="home-slide">
    <div id="tinderslide">
      <ul>
        @foreach($users as $user)
          @if(in_array($user->id, $array))
            @continue
          @endif
            <li data-user_id="{{ $user->id }}">
              @if($user->image)
                <img src="/storage/images/{{$user -> image}}">
              @else
                <img src="/storage/images/person.jpg">
              @endif
              <div class="userInfo">
                <div class="userName"><a href=" {{ route('users.show', ['id' => $user->id]) }} " class="name">{{ $user->name }}  </a><span class="age">{{ $user->age }}歳</span><span class="age"> {{ $user->address }}</span></div>

                <!-- @if($user->type_of_wine || $user->verify_of_wine || $user->favorite_food)
                  <span style="font-size:15px">favorite<i class="fas fa-star" style="font-size:15x; color:yellow"></i></span>
                @endif -->
                <div class="favorites">
                @if($user->verify_of_wine)
                  <div class="verify_of_wine">{{ $user->type_of_wine }}</div>
                @endif
                @if($user->type_of_wine)  
                  <div class="verify_of_wine">{{ $user->verify_of_wine }}</div>
                @endif
                @if($user->favorite_food)
                  <div class="verify_of_wine">{{ $user->favorite_food }}</div>
                @endif
                </div>

                <span class="self_introduction">{{ $user->self_introduction }}</span>
              </div>
            </li>
        @endforeach
      </ul>
      <div class="noUser"><p>ユーザーはもういません<p>
        <a class="search-link" href="{{ route('index') }}">もう一度さがす<i class="fas fa-user-friends" style="color: #563e7b; font-size:16px; font-weight:bold; margin-left: 10px; display:inline-block"></i>
        </a>
      </div>
    </div>
    <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fa fa-angle-left"></i><span style="font-size:10px">次へ</span></a>
      <a href="#" class="like"><i class="far fa-thumbs-up" style="color:#fff; margin-top:5px"></i><span style="font-size:10px">いいね</span></a>
    </div>
  </div>
</div>

<script>
// javascriptファイルで利用する変数を定義(HomeControllerから渡ってきたもの)
var usersNum = {{ $userCount }};//全ユーザーの数
var usersNumSelected = {{ $userCountSelected }};//自分と既にいいね済みのユーザーを除いた数
var from_user_id = {{ $from_user_id }};//ログイン中のユーザーID

$(function() {
    var availableTags = [
      '赤', '白', 'ロゼ', 
      '泡', 'オレンジ', 
      'ポートワイン', 'デザートワイン', 
      'シャルドネ', 'カベルネ・ソーヴィニョン', 'メルロー', 'シラー', 'サンジョベーゼ', 'テンプラリーニョ', 'グルナッシュ', 'ピノ・ノワール', 'リースリング', 'ソーヴィニョン・ブラン', 'ゲウェルツ・トラミネール', 'ヴィオニエ', 'セミヨン', 'ピノ・ブラン', '甲州', 'ケルナー',
      'ボルドー', 'ブルゴーニュ', 'ローヌ', 'ロワール', 'シャンパーニュ', 'アルザス', 'ドイツ', 'アメリカ', 'カルフォルニア', 'オーストラリア', '日本', 'フランス', 'スペイン', 'イタリア', 'シチリア', 'トスカーナ', 'チリ',
      'フレンチ', '中華', 'イタリアン', '和食', 'スパニッシュ', '韓国料理', 'エスニック',
    ];
    $( ".ac" ).autocomplete({
      source: availableTags
    });
  } );

</script>

@endsection
