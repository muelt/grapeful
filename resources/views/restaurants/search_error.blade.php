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

  <span style="color:brown; position:absolute; top:70px; left: 180px">検索キーワードに該当するお店は見つかりませんでした。<br>再度検索を行ってください。</span>

  </div>  


@endsection