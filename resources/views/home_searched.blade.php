@extends('layouts.layout')

@section('content')

<div class="signupPage" style="margin-bottom: 30px;">
  <header class="header">
    <div class="bg-mask">
    </div>
  </header>
</div>

<div class="topPage">
<!-- ユーザーが入力したキーワードで絞り込み -->
  <form class="searchBox" action="{{ route('index_searched') }}" method="POST">
    @csrf
    <input type="search" placeholder="プロフィールからキーワードでさがす(ワインのタイプ、年齢など)" class="searchText ac" name="freeword">
    <button class="btn" type="submit" name="button">
      <i class="fas fa-search" aria-hidden="true"></i>
    </button>
  </form>

  <div class="home-slide">
    <div id="tinderslide">
      <ul>
          @foreach($users_selected as $user)
            <!-- @if(in_array($user->id, $array))
              @continue
            @endif  -->
            <li data-user_id="{{ $user->id }}">
              @if($user->image)
                <img src="/storage/images/{{$user -> image}}">
              @else
                <img src=c>
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
        <a class="search-link" href="{{ route('index') }}"><i class="fas fa-user-friends" style="color: #563e7b; font-size:16px; font-weight:bold"></i> もう一度さがす</a>
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
var usersNumSelected = {{ $userCountSelected }};
var from_user_id = {{ $from_user_id }};//ログイン中のユーザーID

</script>

@endsection
