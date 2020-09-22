@extends('layouts.layout')

@section('content')
<div class="signupPage">
  <header class="header">
    <div>アカウントを作成</div>
  </header>
  <div class='container'>

    <!-- 送信するとregisterコントローラに保存される 1つ1つの項目の処理についてはコントローラー内に書いていく -->
    <form class="form mt-5 register_form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

        <!-- 画像のアップロード -->
        <label for="file_photo" class="rounded-circle userProfileImg">
          <div class="userProfileImg_description">画像をアップロード</div>
          <i class="fas fa-camera fa-3x"></i>
          <input type="file" id="file_photo" name="image">
        </label>
        <div class="userImgPreview" id="userImgPreview">
          <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
          <p class="userImgPreview_text">画像をアップロード済み</p>
        </div>
        <!-- 画像のアップロードはここまで -->



        <div class="form-group @error('name')has-error @enderror">
          <label>名前</label>
          <input type="text" name="name" class="form-control" placeholder="名前を入力してください" value="{{ old('name') }}" >
          <!-- バリデーション -->
          @error('name')
              <span class="errorMessage">
                {{ $message }}
              </span>
          @enderror
        </div>

        <div class="form-group @error('email')has-error @enderror">
          <label>メールアドレス</label>
          <input type="email" name="email" class="form-control" placeholder="メールアドレスを入力してください" value="{{ old('email') }}" >
          @error('email')
          <!-- バリデーション -->
            <span class="errorMessage">
              {{ $message }}
            </span>
          @enderror
        </div>

        <div class="form-group @error('password')has-error @enderror">
          <label>パスワード<em>  ※8文字以上</em></label>
          <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
          <!-- バリデーション -->
          @error('password')
              <span class="errorMessage">
                {{ $message }}
              </span>
          @enderror
      </div>

      <div class="form-group">
        <label>確認用パスワード</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="パスワードを再度入力してください">
      </div>

      <div class="form-group">
        <div><label>性別</label></div>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" checked style="width:20px" value="{{ old('sex') }}" >
            <label class="form-check-label" for="inlineRadio1">男</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2" style="width:20px" value="{{ old('sex') }}" >
            <label class="form-check-label" for="inlineRadio2">女</label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="age">年齢</label>
        <select id="age" type="text" class="form-age" name="age" style="margin-left:30px;" value="{{ old('age') }}" >
          <option value="">未選択</option>
          @foreach(range(20,100) as $year)
          <option value="{{ $year }}">{{ $year }}</option>
          <span>歳</span>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="address">都道府県</label>
          <select id="address" type="text" class="form-address" name="address" style="margin-left:15px;">
            @foreach(config('pref') as $index => $name)
            <option value="{{ $index }}">{{ $name }}</option>
            @endforeach
          </select>
      </div>
        
      <div class="form-group">
        <label for="married">婚姻の有無</label>
          <select id="married" type="text" class="form-married" name="married" style="margin-left:15px;" value="{{ old('married') }}" >
            <option value="">未選択</option>
            <option value="あり">あり</option>
            <option value="なし">なし</option>
          </select>
        </label>
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きなワインのタイプ</label>
        <input type="text" class="form-control" placeholder="赤・白・泡・ロゼ・オレンジ・ポートワイン etc…" name="type_of_wine" value="{{ old('type_of_wine') }}" >
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな品種</label>
        <input type="text" class="form-control ac" placeholder="カベルネソーヴィニョン・シャルドネ・ピノノワールetc…" name="verify_of_wine" value="{{ old('verify_of_wine') }}">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな生産地</label>
        <input type="text" class="form-control ac" placeholder="ボルドー・ブルゴーニュ・カルフォルニアetc…" name="producing_area" value="{{ old('producing_area') }}">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな食べ物/ジャンル</label>
        <input type="text" class="form-control ac" placeholder="フレンチ・中華・イタリアン・和食 etc…" name="favorite_food" value="{{ old('favorite_food') }}">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>飲みに行く場合の予算</label>
        <div><input type="text" class="form-control" placeholder="(例) 7000" name="price_range" value="{{ old('price_range') }}" style="display:inline-block"> 円</div>
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>お気に入りのお店</label>
        <!-- お店の名前 -->
          <a href="{{ route('restaurants.gurunavi') }}" style="display:block">ぐるなびで検索</a>
          @if(isset($shop_name))
            <div>{{ $shop_name }}</div>
            <img src="{{ $image_url }}" alt="">
          @endif
      </div>

      <div class="form-group">
        <label>自己紹介文</label>
        <textarea class="form-control" name="self_introduction" rows="6" style="width:400px" value="{{ old('self_introduction') }}" ></textarea>
        <!-- バリデーション -->
          @error('self_introduction')
          <span class="errorMessage">
            {{ $message }}
          </span>
          @enderror
        </div> 
      </div>

      <div class="text-center">
        <button type="submit" class="btn submitBtn">はじめる</button>
        <div class="linkToLogin">
          <a href="{{ route('login') }}">ログインはこちら</a>
        </div>  
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">

// $(function(){
//   var type = [
//     '赤', '白', 'ロゼ', 
//     '泡', 'オレンジ', 
//     'ポートワイン', 'デザートワイン'
//     'agree',
//   ];

//   $(".ac").autocomplete({
//     source:type
//   });
// });


$(document).ready( function() {
  $( ".ac" ).autocomplete({
    source: [ 
      '赤', '白', 'ロゼ', 
      '泡', 'オレンジ', 
      'ポートワイン', 'デザートワイン' 
    ]
  }
);

</script>

@endsection