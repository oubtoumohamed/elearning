 @extends('standard')

@section('main-content')
  <style type="text/css">
    td{
      text-align: left !important;
    }
  </style>
  <div class="content-wrapper content-page clearfix" id="Partenaire">
    @section('content-header')
      @include('layout.content-header')
    @show
    <div class="col-md-12">
      <div class="container-fluid all_container   box">
        <section class="content" style="margin: 0 !important;border: none;">
          <div class="box-header edit_ttl generale_t" style="margin-bottom: 20px;">
            <h4 class="box-title col-xs-6 col-sm-6 col-lg-6">
              <span>Général</span>
            </h4>
            <div class="retourne_list col-md-6">
              @php
                $controller = Request::route()->controller;
                $model = $controller->model;
              @endphp
              @isGranted('ROLE_'.strtoupper($model).'_LIST')
              <a href="{{ route($model) }}">
                <i class="fa fa-list" aria-hidden="true"></i><div>Retourner à la liste</div>
              </a>
              @endisGranted
            </div>
            <div class="clear"></div>
          </div>
          @yield('content')
        </section>
      </div>
    </div>
  </div>
@endsection