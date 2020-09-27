@extends('layouts.layout')

@section('content')

<div class="restaurants-page">
  <form action="/restaurants/search" method="post" class="search_wrapper">
  @csrf
    <input type="text" name="freeword" id="freeword" placeholder="キーワードで検索">

    <button class="btn btn-primary" type="submit" name="button">
      <i class="fas fa-search" aria-hidden="true"></i>
    </button>
  </form>
</div>  

@endsection

<!-- <form action="/restaurants/search" method="post" class="search_wrapper">
@csrf
  <input type="text" name="freeword" id="freeword" placeholder="キーワードで検索">
  <button class="btn btn-primary" type="submit" name="button">
    <i class="fas fa-search" aria-hidden="true"></i>
  </button>
</form> -->