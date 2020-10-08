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
      <div class="matchingNum">{{ $match_users_count }}人とマッチングしています</div>
      <h2 class="pageTitle">メッセージ</h2>
      <div class="matchingList">
				@foreach( $matching_users as $user)
          <div class="matchingPerson">
          <div style="display:flex">
            @if($user->image)
              <div class="matchingPerson_img"><img src="/storage/images/{{ $user->image}}"></div>
            @else
            <div class="matchingPerson_img"><img src="/storage/images/person.jpg"></div>
            @endif
                <div class="matchingPerson_name"><a href=" {{ route('users.show', ['id' => $user->id]) }} ">{{ $user->name }}</a></div>
          </div> 
            <form method="POST" action="{{ route('chat.show') }}">
            @csrf
              <input name="user_id" type="hidden" value="{{$user->id}}">
              <button type="submit" class="chatForm_btn">トークする</button>
            </form>

          </div>
        @endforeach
      </div>
    <div>
  </div>
</div>

@endsection