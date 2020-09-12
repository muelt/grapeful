@extends('layouts.layout')

@section('content')

<form action="search" method="post">
@csrf
  <input type="text" name="name" id="name">

  <button class="btn btn-primary" type="submit" name="button">検索</button>
</form>

<div>
  <span>{{ $replyText }}</span>
</div>

@endsection