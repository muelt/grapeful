@extends('layouts.layout')

@section('content')

<div class='usershowPage'>

  <div class="reactions" id="actionBtnArea">
  <!-- 設定する。任意の属性を付与 data-  this.data('to_user_id')で宣言すると値が取れる -->
    <a href="#" class="like" style="background:#c3ade7; color:#fff">いいね!済<i class="far fa-thumbs-up" style="color:#fff"></i></a>
  </div>

  <!-- <div id="tinderslide"> -->
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
          <div class='userInfo_age'>{{ $user -> age }}歳</div>
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
        <div class='userInfo_self_introduction' style="width:300px padding:10px 20px; text-align:left">{{ $user -> self_introduction }}</div>
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
    </div>
  <!-- </div> -->
        
</div>

@endsection