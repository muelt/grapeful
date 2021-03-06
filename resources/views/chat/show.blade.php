@extends('layouts.layout')

@section('content')

<!-- 相手のアイコン -->
<div class="chatPage js-chatPage">
  <header class="js-chatHeader" style="width:100%">
    <a href="{{route('matching')}}" class="linkToMatching"></a>
    <div class="chatPartner">
    @if($chat_room_user->image)
      <div class="chatPartner_img"><img src="/storage/images/{{$chat_room_user -> image}}"></div>
    @else
      <div class="chatPartner_img"><img src="/storage/images/person.jpg"></div>
    @endif
      <div class="chatPartner_name">{{ $chat_room_user -> name }}</div>
    </div>
  </header>

<!-- 送信済みのメッセージを表示 -->
  <div class="container">
    <div class="messagesArea messages">
    @foreach($chat_messages as $message)

    <div class="message">
      <!-- dd($message); -->
      @if($message->user_id == Auth::id())
      <div class="message-right">
        <span style="margin-right:10px; position:relative; top:40px; color:#d6d6d6">{{$message->created_at->format('m-d H:i')}}</span>
        <div class="commonMessage">
          <div>
          {{$message->message}}
          </div>
        </div>
        <!-- <span style="padding-top:30px; padding-right:18px">{{Auth::user()->name}}</span> -->
      </div>
      @else
      <div class="message-left">
        <span>{{$chat_room_user_name}}</span>
        <div class="commonMessage">
          <div>
          {{$message->message}}
          </div>
        </div>
        <span style="margin-left:10px; position:relative; top:10px; color:#d6d6d6">{{$message->created_at->format('m-d H:i')}}</span>
      </div>
      @endif
    </div>

    @endforeach
    </div>
  </div>

  <!-- 新規メッセージ入力フォーム -->
  <form class="messageInputForm">
    <div class='container'>
      <input type="text" data-behavior="chat_message" class="messageInputForm_input" placeholder="メッセージを入力...">
    </div>
  </form>
</div>


<script>
var chat_room_id = {{ $chat_room_id }};
var user_id = {{ Auth::user()->id }};
var current_user_name = "{{ Auth::user()->name }}";
var chat_room_user_name = "{{ $chat_room_user_name }}";
</script>

@endsection