@extends('layouts.layout')

@section('content')

<div class="restaurants-page">
  <form action="/restaurants/search" method="get" class="search_wrapper">
  @csrf
    <input type="text" name="freeword" id="freeword" value="{{ $request->freeword }}">

    <button class="btn btn-primary" type="submit" name="button">
      <i class="fas fa-search" aria-hidden="true"></i>
    </button>
  </form>

  <form action="{{ route('restaurant_save') }}" method="post">
    @csrf
    <div class="restaurants-wrapper">
      <input type="hidden" name="shop_name" value="{{ $request->freeword }}">
      @foreach($paginations as $restaurant)
        <div class="restaurant">
          <img src="{{ $restaurant['image_url'] }}" class="restaurant_image">
          <div style="display: inline-block"><a href="{{ $restaurant['url'] }}">{{ $restaurant['shop_name'] }}</a></div>
          <input type="checkbox" name="register_shop[]" value="{{ $restaurant['tel'] }}" style="display:inline">
        </div>  
      @endforeach
      <button type="submit" class="btn submitBtn" style="display:block; width:150px; height:60px; border-radius:40px; margin:30px">お店を登録する</button>
    </div>
  </form>


  <!-- {{ $pagination->links() }} -->

</div>  


@endsection