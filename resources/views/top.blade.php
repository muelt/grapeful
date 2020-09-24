@extends('layouts.layout')

@section('content')

<div class="beginningPage">
  <div class="container">
    <div class="beginningPage_contents">
      <div class="beginningPage_contents_title">
        <h2 class="sub-title">ワイン好きと繋れる</h2>
        <h2 class="sub-title">楽しく飲める友達を探そう</h2>
        <h1 class="title">grapeful</h1>
      </div>
    </div>  
  </div>

  <div class="question_contents">
    <div class="container">
      <h2 class="question_contents_title">こんなお悩みありませんか？</h2>
      <div class="question_contents_wrapper">
        <div class="question_contents_item">
          <h3>ワインが大好きなのにワイン好きが周りにいない<h3>
          <p>周りはビールやハイボール党ばかり…</p>
        </div>
        <div class="question_contents_item">
          <h3>たくさんの種類が飲めない<h3>
          <p>一人だとボトルが開けられず、飲めるワインが限られてしまう…</p>
        </div>
        <div class="question_contents_item">
          <h3>グルメも大好き。気になったお店にはどんどん行ってみたい。<h3>
          <p>ワインとのマリアージュを楽しみたいけど一人だとなかなか…予約も取りづらい</p>
        </div>
        <div class="question_contents_item">
          <h3>大人になると新たな友達って難しい…<h3>
          <p>趣味が合う友達が欲しいなぁ</p>
        </div>
      </div>
    </div>
  </div>

  <div class="answer_contents">
    <h2>そんな悩みをgrapefulが解決！</h2>
    <ul>
      <li>ワイン好きだけが集まるマッチングアプリ</li>
      <li>好きな品種や食べ物から好みが似ている人を探せる</li>
      <p>好みが似てそう…と思ったら良いね！</p>
      <li>お気に入りのお店をみんなでシェア</li>
      <li>ワイン友達を見つけよう</li>
    </ul>
  </div>




    <div class="btn beginningPage_contents_btn"><a class="text-white" href="{{ route('login') }}">メールアドレスでログインする</a></div>
    </div>
</div>

@endsection