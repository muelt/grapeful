@extends('layouts.layout')

@section('content')

<div class="signupPage" style="margin-bottom: 30px;">
  <header class="header">
    <div class="bg-mask">
    </div>
  </header>
</div>

<div class="matchingPage">
  <div class="container">
    <div class="mt-5">
    <div class="matchingNum">{{ $from_me_users_count }}人にあなたからいいね！しました</div>
      <h2 class="pageTitle">いいね！した履歴</h2>
      <div class="matchingList">

				@foreach( $from_me_users as $user)
          <div class="matchingPerson">
            <div style="display:flex">
            @if($user->image)
              <div class="matchingPerson_img"><img src="/storage/images/{{ $user->image}}"></div>
            @else
              <div class="matchingPerson_img"><img src="/storage/images/person.jpg"></div>
            @endif  
              <div class="matchingPerson_name"><a href=" {{ route('users.show', ['id' => $user->id]) }} ">{{ $user->name }}</a></div>
            </div>
            @foreach ($user->toUserIds as $obj)
                @if($obj->from_user_id == Auth::id() && $obj->status == 0)
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