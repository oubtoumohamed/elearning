<!doctype html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="ar" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('img/fav-icon.png') }}"/>
    <link rel="shortcut icon" href="{{ asset('img/fav-icon.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Changa:400,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    @yield('head')
  </head>
  <body class="">


{{--
    @if ($message = Session::get('success'))
    <div class="pop-up">
      <span onclick="this.parentElement.style.display='none'" class="w3-button w3-green w3-large w3-display-topright">&times;</span>
      <p>{!! $message !!}</p>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="pop-up">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-red w3-large w3-display-topright">&times;</span>
        <p>{!! $message !!}</p>
    </div>
    @endif
    <style type="text/css">.pop-up{position: fixed; top: 0px; left: 0px; height: 100vh; background: rgba(0,0,0,0.9); z-index: 10000 !important; width: 100%; color: #ffff; text-align: center; padding: 5%; }.pop-up span{font-size: 1.6em; background: red; height: 35px; width: 35px; text-align: center; display: inline-block; border-radius: 100%; cursor: pointer; }.pop-up p{font-size: 1.6em; margin-top: 20px; }</style>

--}}
    @section('navbar')
    <nav class="navbar navbar-custom">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <i class="fa fa-bars"></i>
          </button>
          <a href="{{ route('home') }}" id="logo" class="navbar-brand" title="{{ config('app.name') }}">
            <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}">
          </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            {{--<li class="home">
              <a href="{{ route('home') }}" ><i class="fa fa-home"></i>{{ __('global.home') }}</a>
            </li>--}}
          </ul>
          <ul class="nav navbar-nav navbar-right">
            {{--<li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <!--i class="fa fa-language"></i--><img src="{{ asset('frontend/img/'.@App::getLocale().'.png') }}" style="width:18px;"> {{ config('languages.'.@App::getLocale()) }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li id="language">
                  <a href="{{ route('home','de') }}">
                    <img src="{{ asset('frontend/img/germany.png') }}"> 
                  </a>
                </li>
              </ul>
            </li>--}}
            @if( Auth::check() )
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user-circle-o"></i>{{ auth()->user() }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                @if( isGranted('ADMIN') )
                <li class="nav-item">
                  <a href="{{ route('admin') }}" class="nav-link">
                    <i class="fa fa-tachometer"></i> 
                    Dashboard
                  </a>
                </li>
                @endif
                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>{{ __('global.logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </ul>
            </li>
            @else
            <li>
              <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> {{ __('global.login') }}</a>
            </li>
            <li>
              <a href="{{ route('register') }}"><i class="fa fa-user-circle-o"></i> {{ __('global.register') }}</a>
            </li>
            @endif
          </ul>
   
     </div>
      </div>
    </nav>

    {{--
    @show
    <div class="container-fluid">      
      @yield('content')

      @section('footer')
        @include('frontend.footer')
      @show
    </div>

    --}}
  </body>
</html>