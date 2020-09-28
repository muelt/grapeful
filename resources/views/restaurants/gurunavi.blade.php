@extends('layouts.layout')

@section('content')

<div class="signupPage">
  <header class="header">
    <div>ぐるなび検索<i class="fas fa-utensils" style="margin: 0 10px"></i>お気に入りのお店を登録</div>
  </header>
  <div class='container'>

  <div class="restaurants-page">
    <form action="/restaurants/search" method="post" class="search_wrapper">
    @csrf
      <input type="text" name="freeword" id="freeword" placeholder="キーワードで検索">

      <button class="btn btn-primary" type="submit" name="button">
        <i class="fas fa-search" aria-hidden="true"></i>
      </button>
    </form>
  </div>  

</div>
@endsection

<!-- <form action="/restaurants/search" method="post" class="search_wrapper">
@csrf
  <input type="text" name="freeword" id="freeword" placeholder="キーワードで検索">
  <button class="btn btn-primary" type="submit" name="button">
    <i class="fas fa-search" aria-hidden="true"></i>
  </button>
</form> -->