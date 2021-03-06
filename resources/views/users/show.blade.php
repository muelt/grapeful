@extends('layouts.layout')

@section('content')

<div class="signupPage" style="margin-bottom: 30px;">
  <header class="header">
    <div class="bg-mask">
    </div>
  </header>
</div>

<div class='usershowPage'>
  <div class='container'>
    <div class='userInfo'>
      <div class='userInfo_img'>
      @if($user->image)
        <img src="/storage/images/{{$user -> image}}">
      @else
        <img src="/storage/images/person.jpg">
      @endif
      </div>
      <div class='userInfo_name'>{{ $user -> name }}</div>

      <!-- ここから -->
      <div class="user_info_group">
        <label for="age">性別</label>
        <div class='userInfo_age'>{{ $user -> sex }}</div>
      </div>

      <div class="user_info_group">
        <label for="age">年齢</label>
        <div class='userInfo_age'>{{ $user -> age }}</div>
      </div>

      <div class="user_info_group">
        <label for="address">都道府県</label>
        <div class='userInfo_address'>{{ $user -> address }}</div>
      </div>

      <div class="user_info_group">
        <label for="married">婚姻の有無</label>
        <div class='userInfo_married'>{{ $user -> married }}</div>
      </div>
    
      <div class="user_info_group">
        <label for="type_of_wine">好きなワインのタイプ</label>
        <div class='userInfo_type_of_wine'>{{ $user -> type_of_wine }}</div>
      </div>
    
      <div class="user_info_group">
        <label for="verify_of_wine">好きな品種</label>
        <div class='userInfo_verify_of_wine'>{{ $user -> verify_of_wine }}</div>
      </div>

      <div class="user_info_group">
        <label for="producing_area">好きな生産地</label>
        <div class='userInfo_producing_area'>{{ $user -> producing_area }}</div>
      </div>

      <div class="user_info_group">
        <label for="favorite_food">好きな食べ物/ジャンル</label>
        <div class='userInfo_favorite_food'>{{ $user -> favorite_food }}</div>
      </div>

      <div class="user_info_group">
        <label for="price_range">飲みに行く場合の予算</label>
        <div class='userInfo_price_range'>{{ $user -> price_range }}円</div>
      </div>

      <div class="user_info_group">
        <label for="self_introduction">自己紹介</label>
        <p class='userInfo_self_introduction'>{{ $user -> self_introduction }}</p>
      </div>

      <div class="user_info_group shop">
        <label for="favorite_restaurant">お気に入りのお店</label>
        <div class="userInfo_favorite_restaurant">
          @if($user->restaurant)
          <div class="shop_name"><a href="{{ $user->restaurant->url }}">{{ $user->restaurant->shop_name }}</a></div>
          <img class="shop_image" src="{{ $user->restaurant->image_url }}" alt="">
          @endif
        </div>
      </div>

      <div class='userAction'>
        <div class="userAction_edit userAction_common">
          <a href="/users/edit/{{$user->id}}"><i class="fas fa-edit fa-2x"></i></a>
          <span>プロフィール<br>を編集</span>
        </div>
        <div class="userAction_edit userAction_common">
          <a href="/restaurants/gurunavi"><i class="fas fa-utensils fa-2x"></i></a>
          <span>お店を編集</span>
        </div>
        <div class='userAction_logout userAction_common'>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><i class="fas fa-cog fa-2x"></i></a>
          <span>ログアウト</span>
          <form id="logout-form" action="{{ route('logout') }}"   method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
  </div>
</div>

@endsection