<!doctype html>
<html>
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
    <link rel="icon" href="{{ asset('img/icon.png') }}"/>
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" />
    <title>{{ config('app.name') }}</title>    
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">

    <!-- Dashboard Core -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
    @if( @App::getLocale() == "ar" )
    <link href="{{ asset('css/dashboard.rtl.css') }}" rel="stylesheet" />
    @endif
    <link href="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" />
    <!--link href="{{ asset('css/dashboard.rtl.css') }}" rel="stylesheet" /-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/select2-ar.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-timepicker-addon.js') }}"></script>
    
    <script type="text/javascript">
      jQuery(document).ready(function(){
        jQuery("select").select2({
          dir: "ltr"
        });
        jQuery(".delete_btn").click( function(){
          jQuery("#delete_confirm_btn").attr("href", $(this).attr("href"));
        });
        $( ".datepicker" ).datepicker({ dateFormat : "yy-mm-dd"});
        $( ".datetimepicker" ).datetimepicker({ dateFormat : "yy-mm-dd", timeFormat: 'HH:mm'});
      });
    </script>
    <style type="text/css">
      #confirmdelete .modal-body{
        text-align: center;
        padding: 50px
      }
      #confirmdelete .modal-body h1{
        color: #cd201f;
      }
      #confirmdelete .modal-footer{
        padding: 0;
      }
      #confirmdelete .modal-footer .btn{
        width: 50%;
        margin: 0;
        border-radius: 0;
        font-size: 1em;
        padding: 10px;
        border: 0;
      }
#language a{
  display: inline-block;
  width: 32%;
  text-align: center;
  padding: 10px;
}
#language a:hover{
  background: #02b4eb;
}
    </style>
    @yield('head')
  </head>
  <body class="">
    <div class="page">
      @section('body')
        <div class="page-main">
          @section('header')
            @include('header')
          @show

          @section('menu')
            @include('menu')
          @show

          <div class="main-content">
            <div class="container main-content-container">
              <div class="page-header m-0 p-2">
                <h1 class="page-title p-3">
                  {{ title() }}
                </h1>
              </div>
              <div class="row">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert"></button>
                  <strong>{{ $message }}</strong>
                </div>
                @endif
                
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert"></button> 
                  <strong>{{ $message }}</strong>
                </div>
                @endif

                @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-block">
                  <button type="button" class="close" data-dismiss="alert"></button>
                  <strong>{{ $message }}</strong>
                </div>
                @endif

                @if ($message = Session::get('info'))
                <div class="alert alert-info alert-block">
                  <button type="button" class="close" data-dismiss="alert"></button>
                  <strong>{{ $message }}</strong>
                </div>
                @endif

                @foreach ($errors->all() as $error) 
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>{{ $error }}</strong>
                  </div>
                @endforeach
                
                @yield('content')
              </div>
            </div>
          </div>
        </div>
     
        <!-- navbar-fixed-top-->
        <div class="clearfix under_menu"></div>

        @section('footer')
          @include('footer')
        @show
      @show

      <div class="modal" tabindex="-1" id="confirmdelete" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h1><i class="fa fa-trash" aria-hidden="true"></i></h1>
              <b>{{ __('global.confirm_delete') }}.</b>
              <br><br>
              <p>{{ __('global.confirm_delete_text') }}.</p>
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-danger" id="delete_confirm_btn" href="">{{ __('global.delete') }}</a>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('global.cancel') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>