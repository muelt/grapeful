@extends('layouts.layout')

@section('content')
<div class="signupPage userEditPage">
  <header class="header">
  </header>
  <div class='container'>
    <form class="form mt-5" method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
    @csrf


    <!-- 画像のアップロード/バリデーション -->
    @error('image')
      <span class="errorMessage">
        {{ $message }}
      </span>
    @enderror
    <div class="title">プロフィールを編集</div>
      <label for="file_photo" class="rounded-circle userProfileImg">
        @if($user->image)
        <div class="userProfileImg_description">画像を編集</div>
        <img src="/storage/images/{{ $user->image }}">
        <input type="file" id="file_photo" name="image">
        @else
        <div class="userProfileImg_description">画像をアップロード</div>
        <input type="file" id="file_photo" name="image">
        <i class="fas fa-camera fa-3x"></i>
        @endif
      </label>
      <div class="userImgPreview" id="userImgPreview">
        <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
        <p class="userImgPreview_text">画像をアップロード済み</p>
      </div>

      <div class="form-group">
        <label>名前</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
      </div>

      <div class="form-group">
        @error('email')
          <span class="errorMessage">
            {{ $message }}
          </span>
        @enderror

        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
      </div>
      <div class="form-group">
        <div><label>性別</label></div>
        <div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="sex" style="width:20px" value="0" type="radio" id="inlineRadio1" @if($user->sex === 0) checked @endif><label class="form-check-label" for="inlineRadio1">男</label>
          </div>

          <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" style="width:20px" value="1" type="radio" id="inlineRadio2" @if($user->sex === 1) checked @endif><label class="form-check-label" for="inlineRadio2">女</label>
          </div>
        </div>  
      </div>

      <div class="form-group">
        <label for="age">年齢</label>
        <select id="age" type="text" class="form-age" name="age" style="margin-left:30px;">
          <option value="">未選択</option>
          @foreach(range(20,100) as $year)
          <option value="{{ $year }}" @if($user->age == $year) selected @endif>{{ $year }}</option>
          <span>歳</span>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="address">都道府県</label>
          <select id="address" type="text" class="form-address" name="address" style="margin-left:15px;">
          @foreach(config('pref') as $index => $name)
            <option value="{{ $index }}" @if($user->address == $name) selected @endif>{{ $name }}</option>
            @endforeach
          </select>
      </div>
      
      <div class="form-group">
        <label for="married">婚姻の有無</label>
          <select id="married" type="text" class="form-married" name="married" style="margin-left:15px;">
            <option value="">未選択</option>
            <option value="あり" @if($user->married == 'あり') selected @endif>あり</option>
            <option value="なし" @if($user->married == 'なし') selected @endif>なし</option>
          </select>
        </label>
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きなワインのタイプ</label>
        <input type="text" class="form-control ac" placeholder="赤・白・泡・ロゼ・オレンジ・ポートワイン etc…" name="type_of_wine" value="{{ $user->type_of_wine }}" >
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな品種</label>
        <input type="text" class="form-control ac" placeholder="カベルネソーヴィニョン・シャルドネ・ピノノワール・メルロー・リースリング etc…" name="verify_of_wine" value="{{ $user->verify_of_wine }}">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな生産地</label>
        <input type="text" class="form-control ac" placeholder="ボルドー・ブルゴーニュ・カルフォルニア・チリ・ドイツ・ローヌ etc…" name="producing_area" value="{{ $user->producing_area }}">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな食べ物/ジャンル</label>
        <input type="text" class="form-control ac" placeholder="フレンチ・中華・イタリアン・和食 etc…" name="favorite_food" value="{{ $user->favorite_food }}">
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>飲みに行く場合の予算</label>
        <input type="text" class="form-control" placeholder="(例) 7000円未満" name="price_range" value="{{ $user->price_range }}">
      </div>

      <div class="form-group">
        <label>自己紹介文</label>
        <textarea class="form-control" name="self_introduction" rows="10" style="width:100%" value="{{ $user->self_introduction }}">{{$user->self_introduction}}
        </textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="btn submitBtn">変更する</button>
      </div>
    </form>
  </div>
</div>

<script>

$(function() {
    var availableTags = [
      '赤', '白', 'ロゼ', 
      '泡', 'オレンジ', 
      'ポートワイン', 'デザートワイン', 
      'シャルドネ', 'カベルネ・ソーヴィニョン', 'メルロー', 'シラー', 'サンジョベーゼ', 'テンプラリーニョ', 'グルナッシュ', 'ピノ・ノワール', 'リースリング', 'ソーヴィニョン・ブラン', 'ゲウェルツ・トラミネール', 'ヴィオニエ', 'セミヨン', 'ピノ・ブラン', '甲州', 'ケルナー',
      'ボルドー', 'ブルゴーニュ', 'ローヌ', 'ロワール', 'シャンパーニュ', 'アルザス', 'ドイツ', 'アメリカ', 'カルフォルニア', 'オーストラリア', '日本', 'フランス', 'スペイン', 'イタリア', 'シチリア', 'トスカーナ', 'チリ',
      'フレンチ', '中華', 'イタリアン', '和食', 'スパニッシュ', '韓国料理', 'エスニック',
    ];
    $( ".ac" ).autocomplete({
      source: availableTags
    });
  } );

</script>

@endsection
