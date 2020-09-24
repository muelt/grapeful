<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-lightness/jquery-ui.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
</head>

<body>
<main class="js-mainVisual">
  <nav class="navbar navbar-expand-lg navbar-light js-header" style="position:fixed; top:0px; left:0px; width:100%; height:70px">
    <a class="navbar-brand" href="{{ route('top') }}" style="color:#563e7b; font-size:20px">grapeful</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('index') }}"><i class="fas fa-user-friends" style="color: #563e7b; font-size:16px; font-weight:bold"></i>さがす</a>
          </li>

          <!-- いいねドロップダウン -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #563e7b; font-size:16px; font-weight:bold">
            <i class="far fa-thumbs-up">いいね</i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('from_users') }}">お相手から</a>
              <a class="dropdown-item" href="{{ route('from_me') }}">自分から</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('matching')}}"><i class="far fa-comments" style="color: #563e7b; font-size:16px; font-weight:bold"></i>メッセージ</a>
          </li>

          <li class="nav-item">
            @if(Auth::check())
            <a class="nav-link" href="/users/show/{{Auth::id()}}"><i class="fas fa-user-circle" style="color: #563e7b; font-size:16px; font-weight:bold"></i>マイページ</a>
            @else
            <a class="nav-link" href="/login"><i class="fas fa-user-circle" style="color: #563e7b; font-size:16px; font-weight:bold"></i>ログイン</a> 
            @endif
          </li>
      </ul>
    </div>
  </nav>
</main>

@yield('content')

<!-- Scripts -->

</body>
</html>