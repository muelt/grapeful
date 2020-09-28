@extends('layouts.layout')

@section('content')
<div class="signupPage">
  <header class="header">
    <div>お気に入りのお店を登録する</div>
  </header>
  <div class='container'>

    <!-- 送信するとregisterコントローラに保存される 1つ1つの項目の処理についてはコントローラー内に書いていく -->
    <form class="form mt-5 register_form" method="post" action="/users/register_update/{{ Auth::id() }}" enctype="multipart/form-data">
    @csrf

      <div class="form-group @error('name')has-error @enderror">
        <label>お気に入りのお店</label>
        <!-- お店の名前 -->
          @if($user->restaurant)
          <div>
            <a href="{{ route('restaurants.gurunavi') }}" style="display:block">お店を変更(ぐるなび検索)</a>
            <div>{{ $user->restaurant->shop_name }}</div>
            <img src="{{ $user->restaurant->image_url }}" alt="">
          </div>  
          @endif
          <div>
            <a href="{{ route('restaurants.gurunavi') }}" style="display:block">ぐるなびで検索</a>
          </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn submitBtn">登録する</button>
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">

</script>

@endsection