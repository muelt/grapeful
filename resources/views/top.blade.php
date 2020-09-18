@extends('layouts.layout')

@section('content')

<div class="loginPage">
  <div class="container">
    <div class="loginPage_contents">
      <div class="loginPage_contents_title" style="text-align:left">
        <h2 style="font-size:20px">ワイン好きと繋れる</h2>
        <h2 style="font-size:20px; position:relative; left:70px">楽しく飲める友達を探そう</h2>
        <h1>Wine Match</h1>
      </div>

      <div class="btn loginPage_contents_btn"><a class="text-white" href="{{ route('login') }}">メールアドレスでログインする</a></div>
      </div>
    </div>
  </div>
</div>

@endsection