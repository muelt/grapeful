@extends('layouts.layout')

@section('content')

<div class="topPage">
  <nav class="nav">
    <ul>
      <li class="personIcon">
        <a href="/users/show/{{Auth::id()}}"><i class="fas fa-user fa-2x"></i></a></li>
      <li class="appIcon"><a href="{{route('index')}}"><i class="fas fa-wine-glass fa-2x"></i></a></li>
      
      <!-- ここの行を追加 -->
      <li class="messageIcon"><a href="{{route('matching')}}"><i class="fas fa-2x fa-comments"></a></i></li>
      
    </ul>
  </nav>
  <div id="tinderslide">
    <ul>
        @foreach($users as $user)
          @if( $user->id == Auth::id())
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
    <div class="noUser">近くにお相手がいません。</div>
  </div>
  <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
      <a href="#" class="like"><i class="fas fa-heart fa-2x"></i></a>
  </div>
</div>

<script>
// javascriptファイルで利用する変数を定義(HomeControllerから渡ってきたもの)
var usersNum = {{ $userCount }};//全ユーザーの数
var from_user_id = {{ $from_user_id }};//ログイン中のユーザーID
</script>

@endsection
