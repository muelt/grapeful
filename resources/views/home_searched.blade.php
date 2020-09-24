@extends('layouts.layout')

@section('content')



<div class="topPage">
<!-- ユーザーが入力したキーワードで絞り込み -->
  <form class="searchBox" action="{{ route('index_searched') }}" method="POST">
    @csrf
    <input type="search" placeholder="ワインの（タイプ・品種・生産地）でさがす" class="searchText" name="freeword">
    <button class="btn" type="submit" name="button">
      <i class="fas fa-search" aria-hidden="true"></i>
    </button>
  </form>

  <div id="tinderslide">
    <ul>
    
        @foreach($users_selected as $user)
          <!-- @if(in_array($user->id, $array))
            @continue
          @endif  -->
            <li data-user_id="{{ $user->id }}">
              <img src="/storage/images/{{ $user->image }}">
              <div class="userInfo">
                <div class="userName"><a href=" {{ route('users.show', ['id' => $user->id]) }} ">{{ $user->name }}</a></div>
                <div class="age">{{ $user->age }}歳</div>
                <div class="verify_of_wine">{{ $user->verify_of_wine }}がすき</div>
              <div>

              <div class="actions" id="actionBtnArea">
                <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
                <a href="#" class="like"><i class="far fa-thumbs-up" style="font-size:25px"></i ></a>
              </div>
            </li>
        @endforeach
    </ul>
    <!-- <div class="noUser">スキップしたお相手をみる</div> -->
  </div>

</div>

<script>
// javascriptファイルで利用する変数を定義(HomeControllerから渡ってきたもの)
var usersNum = {{ $userCount }};//全ユーザーの数
var from_user_id = {{ $from_user_id }};//ログイン中のユーザーID
</script>

@endsection
