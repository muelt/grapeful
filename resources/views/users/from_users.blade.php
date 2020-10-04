@extends('layouts.layout')

@section('content')

<div class="matchingPage">

  <div class="container">
    <div class="mt-5">
     <div class="matchingNum">{{ $from_users_count }}人があなたにいいね！しました</div>
      <h2 class="pageTitle">いいね！された履歴</h2>
      <div class="matchingList">
				@foreach( $from_users as $user)
          <div class="matchingPerson">
            <div style="display:flex">
              <div class="matchingPerson_img">
              @if($user->image)
                <img src="/storage/images/{{$user -> image}}">
              @else
                <img src="/storage/images/person.jpg">
              @endif
              </div>
              <div class="matchingPerson_name"><a href=" {{ route('users.show', ['id' => $user->id]) }} ">{{ $user->name }}</a></div>
            </div>  
            @foreach ($user->fromUserIds as $obj)
                @if($obj->to_user_id == Auth::id())
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