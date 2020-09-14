@extends('layouts.layout')

@section('content')

<form action="/restaurants/search" method="post" class="search_wrapper">
@csrf
  <input type="text" name="freeword" id="freeword" value="{{ $request->freeword }}">

  <button class="btn btn-primary" type="submit" name="button">
    <i class="fas fa-search" aria-hidden="true"></i>
  </button>
</form>

<div class="restaurants-wrapper">
    @foreach($array as $restaurant)
      <div class="restaurant">
          <img src="{{ $restaurant['image_url'] }}" class="restaurant_image">
          <div style="display: inline-block">{{ $restaurant['name'] }}</div>
          <input type="checkbox">
      </div>  
    @endforeach
</div>

<button type="submit" class="btn submitBtn">お店を登録する</button>

@endsection