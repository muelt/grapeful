@extends('layouts.layout')

@section('content')

<!-- ユーザーが入力したキーワードで絞り込み -->
<div class="topPage">
  <form class="searchBox" action="{{ route('index_searched') }}" method="POST">
    @csrf
    <input type="search" placeholder="ワインの（タイプ・品種・生産地）でさがす" class="searchText ac" name="freeword">
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
              <img src="/storage/images/{{ $user->image }}">
              <div class="userInfo">
                <div class="userName"><a href=" {{ route('users.show', ['id' => $user->id]) }} ">{{ $user->name }}  </a>{{ $user->age }}歳</div>
                <div class="verify_of_wine">{{ $user->verify_of_wine }}がすき</div>
                <div class="self_introduction">{{ $user->self_introduction }}</div>
                
                <div class="like"></div>
                <div class="dislike"></div>
              </div>
            </li>
        @endforeach
      </ul>
      <div class="noUser">近くにお相手がいません。</div>
    </div>
    <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
      <a href="#" class="like"><i class="far fa-thumbs-up"></i></a>
    </div>
  </div>
</div>

<script>
// javascriptファイルで利用する変数を定義(HomeControllerから渡ってきたもの)
var usersNum = {{ $userCount }};//全ユーザーの数
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
