@php 

    if( Request::getHost() == 'm.kooralife.com' ){
        $main_view = 'frontend.main_mobile';
    }else{
        $main_view = 'frontend.main_desktop';
    }
    
    $title = "404";
    $active = "";
    

@endphp

@extends($main_view)

@section('content')
    <img src="{{ asset('img/404.png') }}" alt="404" id="p404" style="margin: 0 auto;display: block;" />
@endsection