@extends('layouts.layout')

@section('content')

<form action="/restaurants/search" method="post">
@csrf
  <input type="text" name="freeword" id="freeword">

  <button class="btn btn-primary" type="submit" name="button">検索</button>
</form>

@endsection