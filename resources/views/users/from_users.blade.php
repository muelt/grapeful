@extends('layouts.layout')

@section('content')

<div class="matchingPage">

  <div class="container">
    <div class="mt-5">
     <div class="matchingNum">{{ $from_users_count }}人にあなたにいいね！しました</div>
      <h2 class="pageTitle">いいね！された履歴</h2>
      <div class="matchingList">
				@foreach( $from_users as $user)
          <div class="matchingPerson">
          <div class="matchingPerson_img"><img src="/storage/images/{{ $user->image}}"></div>
            <div class="matchingPerson_name"><a href=" {{ route('users.show', ['id' => $user->id]) }} ">{{ $user->name }}</a></div>

            <!-- <form method="POST" action="{{ route('chat.show') }}">
            @csrf
              <input name="user_id" type="hidden" value="{{$user->id}}">
              <button type="submit" class="chatForm_btn">チャットを開く</button>
            </form> -->

          </div>
        @endforeach
      </div>
    <div>
  </div>
</div>

@endsection