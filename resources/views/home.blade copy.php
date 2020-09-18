@extends('layouts.layout')

@section('content')

<div class="topPage">

  <div id="tinderslide">
    <ul>
        @foreach($users as $user)
          @if(in_array($user->id, $array))
            @continue
          @endif 
            <li data-user_id="{{ $user->id }}">
              <div class="userName">{{ $user->name }}</div>
              <img src="/storage/images/{{ $user->image }}">
              <div class="like"></div>
              <div class="dislike"></div>
            </li>
        @endforeach
    </ul>
    <div class="noUser">スキップしたお相手をみる</div>
  </div>
  <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
      <a href="#" class="like"><i class="far fa-thumbs-up" style="font-size:25px"></i ></a>
  </div>
</div>

<script>
// javascriptファイルで利用する変数を定義(HomeControllerから渡ってきたもの)
var usersNum = {{ $userCount }};//全ユーザーの数
var from_user_id = {{ $from_user_id }};//ログイン中のユーザーID
</script>

@endsection
