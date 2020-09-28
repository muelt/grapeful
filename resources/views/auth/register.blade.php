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
        <!-- バリデーション -->
          @error('image')
            <span class="errorMessage">
              {{ $message }}
            </span>
          @enderror
        <label for="file_photo" class="rounded-circle userProfileImg">
          <div class="userProfileImg_description">画像をアップロード</div>
          <i class="fas fa-camera fa-3x"></i>
          <input type="file" id="file_photo" name="image">
        </label>
        
        <div class="userImgPreview" id="userImgPreview">
          <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="{{ old('image') }}">
          <p class="userImgPreview_text">画像をアップロード済み</p>
        </div>
        <!-- 画像のアップロードはここまで -->



        <div class="form-group @error('name')has-error @enderror">
          <label>名前</label>
          <div>
            <!-- バリデーション -->
            @error('name')
              <span class="errorMessage">
                {{ $message }}
              </span>
            @enderror
            <input type="text" name="name" class="form-control" placeholder="名前を入力してください" value="{{ old('name') }}" >
          </div>
        </div>

        <div class="form-group @error('email')has-error @enderror">
          <label>メールアドレス</label>
          <div>
            @error('email')
            <!-- バリデーション -->
              <span class="errorMessage">
                {{ $message }}
              </span>
            @enderror
            <input type="email" name="email" class="form-control" placeholder="メールアドレスを入力してください" value="{{ old('email') }}" >
          </div>  
        </div>

        <div class="form-group @error('password')has-error @enderror">
          <label>パスワード<em>  ※8文字以上</em></label>
          <div>
            <!-- バリデーション -->
            @error('password')
              <span class="errorMessage">
                {{ $message }}
              </span>
            @enderror
            <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
          </div>
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
        <select id="age" type="text" class="form-age" name="age" style="margin-left:30px;">
          <option value="">未選択</option>
          @foreach(range(20,100) as $year)
          <option value="{{ $year }}" @if(old('age') == $year) selected @endif>{{ $year }}</option>
          <span>歳</span>
          @endforeach
        </select>
      </div>


      <div class="text-center">
        <button type="submit" class="btn submitBtn">登録をする</button>
        <div class="linkToLogin">
          <a href="{{ route('login') }}">ログインはこちら</a>
        </div>  
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">

$( function() {
    var availableTags = [
      '赤', '白', 'ロゼ', 
      '泡', 'オレンジ', 
      'ポートワイン', 'デザートワイン', 
      'シャルドネ', 'カベルネ・ソーヴィニョン', 'メルロー', 'シラー', 'サンジョベーゼ', 'テンプラリーニョ', 'グルナッシュ', 'ピノ・ノワール', 'シャルドネ', 'リースリング', 'ソーヴィニョン・ブラン', 'ゲウェルツ・トラミネール', 'ヴィオニエ', 'セミヨン', 'ピノ・ブラン', '甲州', 'ケルナー',
      'ボルドー', 'ブルゴーニュ', 'ローヌ', 'ロワール', 'シャンパーニュ', 'アルザス', 'ドイツ', 'アメリカ', 'カルフォルニア', 'オーストラリア', '日本', 'フランス', 'スペイン', 'イタリア', 'シチリア', 'トスカーナ', 'チリ',
      'フレンチ', '中華', 'イタリアン', '和食', 'スパニッシュ', '韓国料理', 'エスニック',
    ];
    $( ".ac" ).autocomplete({
      source: availableTags
    });
  } );
</script>

@endsection