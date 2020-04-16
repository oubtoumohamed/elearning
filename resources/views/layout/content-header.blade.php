<section class="content-header">
  <div class="top_breadcrumb col-xs-12 col-sm-5" style="text-align: left; padding:0;">
    <h4 id="navbartitle" style="margin:0; display: inline-block;">
      @php
        $controller = Request::route()->controller;
        $model = $controller->model;
        $currentAction = Request::route()->action['as'];
        echo __($controller->model.'.'.$currentAction);
      @endphp
    </h4>
  </div>
  <div class="top_breadcrumb col-xs-12 col-sm-2" style="text-align: center;">
    <h4 style="margin:0;" class="today_date"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;{{ date('d/m/Y') }}</h4>
  </div>
  <div class="top_breadcrumb col-xs-12 col-sm-5" style="text-align: right; font-size: 12px;">
    <ol style=" float:right;" class="nav navbar-top-links breadcrumb">
      <li>
        <a href="/admin/rlsh/dashboard">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li>
        <a href="{{ route($model) }}">{{ __($model.'.module_name') }}</a>
      </li>
      <li class="active"><span >@if($model == $currentAction) {{ __($model.'.module_name') }} @elseif($object) {{ $object->__toString() }} @else {{ __($controller->model.'.'.$currentAction) }} @endif</span></li>
    </ol>
  </div>
  <div class="clear"></div>

  <div class="row four_box">
    <div class="col-xs-12 col-sm-6 col-md-3 one_box">
      <div class="dashboard-stat dashboard-stat-v2 bg-blue">
        <div class="visual">
          <i class="fa fa-users"></i>
        </div>
        <div class="details">
          <a href="/admin/rslh/partenaire/partenaire/list" >
            <div class="desc big2">Total Partenaires<span id="total_partenaire" data-counter="counterup"></span></div>
            <div class="desc small2">Total Représentants<span id="total_representant"></span></div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 one_box">
      <div class="dashboard-stat dashboard-stat-v2 bg-purple">
        <div class="visual">
          <i class="fa fa-file-text-o"></i>
        </div>
        <div class="details">
          <a href="/admin/rslh/convention/convention/list">
            <div class="desc big4 T">Total Conventions<span id="total_conventions" data-counter="counterup"></span></div>
            <div class="desc small2">Total Partenaires<span id="total_partenaireconv"></span></div>
            <div class="desc small2">Total Programmes<span id="total_progconv"></span></div>
            <div class="desc small2">Total Versements<span id="total_versements"></span></div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 one_box">
      <div class="dashboard-stat dashboard-stat-v2 bg-green">
        <div class="visual">
          <i class="fa fa-tasks"></i>
        </div>
        <div class="details">
          <a href="/admin/rslh/programme/programme/list">
            <div class="desc big2">Total Programmes<span data-counter="counterup" id="total_programme"></span></div>
            <div class="desc small2">Total Partenaires<span id="total_partenaireprog"></span></div>
          </a>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3 one_box">
      <div class="dashboard-stat dashboard-stat-v2 bg-red">
            <div class="visual">
                <i class="fa fa-opera"></i>
            </div>
            <div class="details">
              <a href="/admin/rslh/operation/operation/list">
              <div class="desc big2">Total Opérations<span id="total_operation" data-counter="counterup"> </span></div>
              </a>
              <a href="/admin/rslh/projet/projet/list">
          <div class="desc small2">Total Projets<span id="total_projet"></span></div>
          </a>
          <a href="/admin/rslh/lot/lot/list">
          <div class="desc small2">Total Lots<span id="total_lot"></span></div>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

  @if($errors->all())
    <div class="col-md-12">
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul style="padding: 0 0px; list-style: none; ">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
