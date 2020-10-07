@extends('layouts.layout')

@section('content')

<div class="beginningPage">
  <div class="container">
    <div class="beginningPage_contents">
      <div class="beginningPage_contents_title">
        <h2 class="sub-title">ワイン好きとつながれる</h2>
        <h2 class="sub-title">楽しく飲める友達を探そう</h2>
        <h1 class="title">grapeful</h1>
      </div>
    </div>  
  </div>

  <div class="question_contents">
    <div class="container">
      <h2 style="text-align:center"><span class="question_contents_title">こんなお悩みありませんか？</span></h2>
      <div class="question_contents_wrapper">
        <div class="question_contents_item">
          <h3>ワインが大好きなのにワイン好きが周りにいない。美味しいお店の情報交換がしたい。<h3>
          <p>周りはビールやハイボール党ばかり…</p>
        </div>
        <div class="question_contents_item">
          <h3>たくさんの種類が飲めない<h3>
          <p>一人だとボトルが開けられず、飲めるワインが限られてしまう…</p>
        </div>
        <div class="question_contents_item">
          <h3>グルメも大好き。気になったお店にはどんどん行ってみたい。<h3>
          <p>ワインとのペアリングも楽しみたいけど一人だとなかなか…予約も取りづらい。</p>
        </div>
        <div class="question_contents_item">
          <h3>大人になると新たな友達作りって難しい…<h3>
          <p>コロナでイベントへの参加は難しいし、出会う場所がないな…。<br>ワイン✖️グルメを一緒に楽しめる友達が欲しい。</p>
        </div>
      </div>
    </div>
  </div>

  <div class="answer_contents">
    <h2 class="answer-title">そんなお悩みをgrapefulが解決！</h2>
    <div class="answers">
      <div>ワイン好きだけが集まるマッチングアプリ</div>
      <div>ワインや食べ物から好みが似ている人を探せる</div>
    </div>
    <div class="answer">お気に入りのお店をみんなでシェア</div>
    <!-- <a href="" class="arrow"></a>
    <div class="answer recommend">楽しく飲める友達を見つけよう</div> -->
    <!-- <p style="display: inline-block">好みが似てそう…と思ったら良いね！</p> -->
  </div>

  <div class="howTo">
    <h3 style="text-align:center"><span class="howTo_title">grapefulの使い方</span></h3>
    <p>使い方はかんたん。ステップをご紹介します。</p>
    <ul>
      <li class="step">
        <h4>step1</h4>
        <img src="" alt="">
        <p>気が合いそうな<br>ユーザーを探す</p>
      </li>
      <li class="step">
        <h4>step2</h4>
        <img src="" alt="">
        <p>気になるユーザーに<br>「いいね！」をしよう</p>
      </li>
      <li class="step">
        <h4>step3</h4>
        <img src="" alt="">
        <p>お相手も「いいね！」<br>をしたらマッチング</p>
      </li>
      <li class="step">
        <h4>step4</h4>
        <img src="" alt="">
        <p>マッチングしたら<br>メッセージを交換しよう</p>
      </li>

    </ul>
  </div>
</div>


  <div class="beginningPage_btn_wrapper">
    <div class="btn beginningPage_btn"><a class="text-white" href="{{ route('register') }}">さっそくはじめてみる</a></div>
  </div>

@endsection