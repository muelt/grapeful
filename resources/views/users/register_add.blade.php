@extends('layouts.layout')

@section('content')
<div class="signupPage">
  <header class="header">
    <div>プロフィールを入力する</div>
  </header>
  <div class='container'>

    <!-- 送信するとregisterコントローラに保存される 1つ1つの項目の処理についてはコントローラー内に書いていく -->
    <form class="form mt-5 register_form" method="post" action="/users/register_update/{{ Auth::id() }}" enctype="multipart/form-data">
    @csrf

      <div class="form-group">
        <label for="address">都道府県</label>
          <select id="address" type="text" class="form-address" name="address" style="margin-left:15px;">
            @foreach(config('pref') as $index => $name)
            <option value="{{ $index }}" @if($user->address == $name) selected @else (old('address') == $name) selected @endif>{{ $name }}</option>
            @endforeach
          </select>
      </div>
        
      <div class="form-group">
        <label for="married">婚姻の有無</label>
          <select id="married" type="text" class="form-married" name="married" style="margin-left:15px;" value="{{ old('married') }}" >
            <option value="">未選択</option>
            <option value="あり" @if($user->married == 'あり') selected @else(old('married') == 'あり') selected @endif>あり</option>
            <option value="なし" @if($user->married == 'あり') selected @else(old('married') == 'なし') selected @endif>なし</option>
          </select>
        </label>
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きなワインのタイプ</label>
        <input type="text" class="form-control ac" placeholder="赤・白・泡・ロゼ・オレンジ・ポートワイン etc…" name="type_of_wine" value="{{ old('type_of_wine') }}" >
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな品種</label>
        @if($user->verify_of_wine)
        <input type="text" class="form-control ac" placeholder="カベルネソーヴィニョン・シャルドネ・ピノノワールetc…" name="verify_of_wine" value="{{ $user -> verify_of_wine }}">
        @else
        <input type="text" class="form-control ac" placeholder="カベルネソーヴィニョン・シャルドネ・ピノノワールetc…" name="verify_of_wine" value="{{ old('verify_of_wine') }}">
        @endif
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな生産地</label>
        @if($user->producing_area)
        <input type="text" class="form-control ac" placeholder="ボルドー・ブルゴーニュ・カルフォルニアetc…" name="producing_area" value="{{ $user->producing_area }}">
        @else
        <input type="text" class="form-control ac" placeholder="ボルドー・ブルゴーニュ・カルフォルニアetc…" name="producing_area" value="{{ old('producing_area') }}">
        @endif
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>好きな食べ物/ジャンル</label>
        @if($user->favorite_food)
        <input type="text" class="form-control ac" placeholder="フレンチ・中華・イタリアン・和食 etc…" name="favorite_food" value="{{ $user->favorite_food }}">
        @else
        <input type="text" class="form-control ac" placeholder="フレンチ・中華・イタリアン・和食 etc…" name="favorite_food" value="{{ old('favorite_food') }}">
        @endif
      </div>

      <div class="form-group @error('name')has-error @enderror">
        <label>飲みに行く場合の予算</label>
        @if($user->price_range)
        <div><input type="text" class="form-control" placeholder="(例) 7000" name="price_range" value="{{ $user->price_range }}" style="display:inline-block"> 円</div>
        @else
        <div><input type="text" class="form-control" placeholder="(例) 7000" name="price_range" value="{{ old('price_range') }}" style="display:inline-block"> 円</div>
        @endif
      </div>

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

      <div class="form-group">
        <label>自己紹介文</label>
        @if($user->self_introduction)
        <textarea class="form-control" name="self_introduction" rows="6" style="width:400px" value="{{ $user->self_introduction }}"></textarea>
        @else
        <textarea class="form-control" name="self_introduction" rows="6" style="width:400px" value="{{ old('self_introduction') }}"></textarea>
        @endif
        <!-- バリデーション -->
          @error('self_introduction')
          <span class="errorMessage">
            {{ $message }}
          </span>
          @enderror
        </div> 
      </div>

      <div class="text-center">
        <button type="submit" class="btn submitBtn">登録する</button>
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