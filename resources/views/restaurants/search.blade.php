@extends('layouts.layout')

@section('content')

<form action="/restaurants/search" method="post" class="search_wrapper">
@csrf
  <input type="text" name="freeword" id="freeword" value="{{ $request->freeword }}">

  <button class="btn btn-primary" type="submit" name="button">
    <i class="fas fa-search" aria-hidden="true"></i>
  </button>
</form>

<div>
  <span>{{ $replyText }}</span>
</div>

<!-- 取得した店舗の情報を1つ1つ取り出して表示したい -->
<!-- <div class="container">
    <div class="restaurants">
    @foreach($replyText as $restaurant)
      <img src="{{ $restaurant->image_url }}">
      <div>{{ $restaurant->name }}</div>
    @endforeach
    </div>
</div> -->


@endsection