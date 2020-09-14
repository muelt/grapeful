@extends('layouts.layout')

@section('content')

<div class="matchingPage">
  <header class="header">
    <i class="fas fa-comments fa-3x"></i>
    <div class="header_logo"><a href="{{ route('index') }}"><i class="fas fa-wine-glass fa-3x"></i></a></div>
  </header>
  <div class="container">
    <div class="mt-5">
      <div class="matchingNum">人とマッチングしています</div>
      <h2 class="pageTitle">いいね！された履歴</h2>
      <div class="matchingList">
				@foreach( $like_to_users as $user)
          <div class="matchingPerson">
          <div class="matchingPerson_img"><img src="/storage/images/{{ $user->image}}"></div>
            <div class="matchingPerson_name">{{ $user->name }}</div>

            <form method="POST" action="{{ route('chat.show') }}">
            @csrf
              <input name="user_id" type="hidden" value="{{$user->id}}">
              <button type="submit" class="chatForm_btn">チャットを開く</button>
            </form>

          </div>
        @endforeach
      </div>
    <div>
  </div>
</div>

@endsection