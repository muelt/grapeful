@extends('layouts.layout')

@section('content')
<div class="signupPage">
  <header class="header">
    <div>アカウントを作成</div>
  </header>
  <div class='container'>

    <form class="form mt-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

      <label for="file_photo" class="rounded-circle userProfileImg">
        <div class="userProfileImg_description">画像をアップロード</div>
        <i class="fas fa-camera fa-3x"></i>
        <input type="file" id="file_photo" name="image">

      </label>
      <div class="userImgPreview" id="userImgPreview">
        <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
        <p class="userImgPreview_text">画像をアップロード済み</p>
      </div>
      <div class="form-group @error('name')has-error @enderror">
        <label>名前</label>
        <input type="text" name="name" class="form-control" placeholder="名前を入力してください">
        @error('name')
            <span class="errorMessage">
              {{ $message }}
            </span>
        @enderror
  
    </div>
      <div class="form-group @error('email')has-error @enderror">
        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control" placeholder="メールアドレスを入力してください">
        @error('email')
            <span class="errorMessage">
              {{ $message }}
            </span>
        @enderror
      </div>
      <div class="form-group @error('password')has-error @enderror">
        <label>パスワード</label>
        <em>6文字以上入力してください</em>
        <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
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
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" checked>
          <label class="form-check-label" for="inlineRadio1">男</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2">
          <label class="form-check-label" for="inlineRadio2">女</label>
        </div>
      </div>
      <div class="form-group">
        <label for="age">年齢</label>
        <select id="age" type="text" class="form-age" name="age" style="margin-left:30px;">
          <option value="">未選択</option>
          @foreach(range(20,100) as $year)
          <option value="{{ $year }}">{{ $year }}</option>
          <span>歳</span>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="address">居住地</label>
          <select id="address" type="text" class="form-address" name="address" style="margin-left:15px;">
            @foreach(config('pref') as $key => $score)
            <option value="{{ $key }}">{{ $score }}</option>
            @endforeach
          </select>
      </div>
      
      <div class="form-group">
        <label for="married">婚姻の有無</label>
          <select id="married" type="text" class="form-married" name="married" style="margin-left:15px;">
            <option value="">未選択</option>
            <option value="0">有</option>
            <option value="1">無</option>
          </select>
        </label>
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きなワインのタイプ</label>
        <input type="text" name="name" class="form-control" placeholder="赤・白・泡・ロゼ・オレンジ・ポートワイン etc…">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな品種</label>
        <input type="text" name="name" class="form-control" placeholder="カベルネソーヴィニョン・シャルドネ・ピノノワール・メルロー・リースリング etc…">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな生産地</label>
        <input type="text" name="name" class="form-control" placeholder="ボルドー・ブルゴーニュ・カルフォルニア・チリ・ドイツ・ローヌ etc…">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな食べ物/ジャンル</label>
        <input type="text" name="name" class="form-control" placeholder="フレンチ・中華・イタリアン・和食 etc…">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>飲みに行く場合の予算</label>
        <input type="text" name="name" class="form-control" placeholder="(例) 7000円未満">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>お気に入りのお店</label>
        <img src="">
        <!-- お店の名前 -->
        <span></span>
      </div>

      <div class="form-group">
        <label>自己紹介文</label>
        <textarea class="form-control" name="self_introduction" rows="10"></textarea>
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
@endsection