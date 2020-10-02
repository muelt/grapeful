@extends('layouts.layout')

@section('content')

<div class="matchingPage">

  <div class="container">
    <div class="mt-5">
    <div class="matchingNum">{{ $from_me_users_count }}人にあなたからいいね！しました</div>
      <h2 class="pageTitle">いいね！した履歴</h2>
      <div class="matchingList">

				@foreach( $from_me_users as $user)
          <div class="matchingPerson">
            <div style="display:flex">
              <div class="matchingPerson_img"><img src="/storage/images/{{ $user->image}}"></div>
              <div class="matchingPerson_name"><a href=" {{ route('users.show', ['id' => $user->id]) }} ">{{ $user->name }}</a></div>
            </div>
            @foreach ($user->toUserIds as $obj)
                @if($obj->from_user_id == Auth::id())
                  <span>{{ $obj->created_at }}</span>
                @endif
            @endforeach
          </div>

        @endforeach
      </div>
    <div>
  </div>
</div>

@endsection