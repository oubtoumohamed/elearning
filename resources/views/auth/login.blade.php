<!doctype html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="fr" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{ asset('img/fav-icon.png') }}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icon.png') }}" />
    <title>{{ config('app.name') }}</title>    
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Dashboard Core -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="{{ asset('img/logo.png') }}" class="h-9" alt="">
              </div>

              <form class="card" action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <div class="card-body p-6">

                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="form-label">{{ __('auth.email') }}</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@example.com" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="form-label">
                      {{ __('auth.password') }}
                      <!-- a href="{{ route('password.request') }}" class="float-right small">استعادة كلمة المرور ؟</a -->
                    </label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required placeholder="123">

                    @if ($errors->has('password'))
                      <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                      <span class="custom-control-label">{{ __('auth.remember') }}</span>
                    </label>
                  </div>

                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('auth.validate') }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <style type="text/css">
        .help-block{
            color: #f00;
        }
    </style>
  </body>
</html>