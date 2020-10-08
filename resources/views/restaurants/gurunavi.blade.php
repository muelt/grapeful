@extends('layouts.layout')

@section('content')

<div class="signupPage">
  <header class="header">
  </header>
  <div class="title">ぐるなび検索<i class="fas fa-utensils" style="margin-right:10px; margin-left:10px"></i>お気に入りのお店を登録</div>
  <div class='container'>
  <div class="restaurants-page">
    <form action="/restaurants/search" method="get" class="search_wrapper">
    @csrf
      <input type="text" name="freeword" id="freeword" placeholder="キーワードで検索">

      <button class="btn btn-primary" type="submit" name="button">
        <i class="fas fa-search" aria-hidden="true"></i>
      </button>
    </form>
  </div>  

</div>
@endsection
