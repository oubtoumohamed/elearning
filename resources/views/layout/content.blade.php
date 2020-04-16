@extends('standard')

@section('main-content')
  <div class="content-wrapper content-page clearfix" id="Partenaire">
    @section('content-header')
      @include('layout.content-header')
    @show
    
    <div class="col-md-12">
      <div class="container-fluid liste portlet box">
        <div class="portlet-title">
          <div class="caption">
            <i style="color:white;" class="fa fa-list" aria-hidden="true"></i>
            
      <?php
        $controller = Request::route()->controller;
        $model = $controller->model;
        $currentAction = Request::route()->action['as'];
        echo __($controller->model.'.list_');
      ?>
          </div>
          <div class="tools">
            @section('export')
            <div class="export">
              <a target="_blank" href="#" title="Export : xls">
                <i class="fa fa-xls" aria-hidden="true"></i>
              </a>
              <a target="_blank" href="#" title="Export : pdf">
                <i class="fa fa-pdf" aria-hidden="true"></i>
              </a>
            </div>
            @show
          </div>
        </div>
        <section class="content" style="margin: 0 !important;border: none;">
          <div class="row_ row rowlist">
            <style type="text/css">.custom_filter .date input{width: 100% !important;}.custom_filter .date .input-group-addon{position: absolute; top: 0px;z-index: -999999 !important;}.custom_filter .date input{width: 104px}</style>
            <!-- oubtou -->
            @section('limit')
            <div class="conter col-md-12 col-lg-12 top_buttons">
              <div class="col-xs-12 col-md-12 col-lg-5 left pull-left one_of_three">
                <select class="per-page small form-control" id="perpage" style="width: auto">
                  <?php
                    $pages__ = [16,32,64,128,192];
                    $currnt_page__ = $controller->perpage();
                    $url__ = $controller->url_params(true,['perpage'=>'mypagenull']);

                    foreach ($pages__ as $perpage) {
                      $selected = ( $perpage == $currnt_page__ ) ? 'selected="selected"' : '';

                      echo '<option '.$selected.' value="'.str_replace('mypagenull', $perpage, $url__).'">'.$perpage.'</option> ';

                    }
                  ?>
                </select>
                @if($results) {{ __('global.pages_list',[
                  'current'=> $results->currentPage(),
                  'length'=> $results->lastPage(),
                  'total'=> $results->total(),
                  'module'=>__($controller->model.'.'.$controller->model)
                  ]) }} @endif
              </div>
              <script type="text/javascript">
                $(document).ready(function(){
                  $('#perpage').change(function(){
                    window.location = $(this).val();
                  });
                  $('#list_checkbox').change(function(){
                    $('.idx').prop('checked',$(this).is(':checked'));
                  });
                });
              </script>
              <div class="col-xs-12 col-md-6 col-lg-2 one_of_thre" style="text-align:center;">
                <div class="archive_menu ">
                  <div class="btn-group btn-danger pull-center">
                    <button type="button" class="btn btn-danger btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">
                      Actif <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                      <li>
                        <a href="?archived=1">Archivées</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-5 right pull-right three_of_three Add_button">

                @isGranted('ROLE_'.strtoupper($model).'_CREATE')
                  <a class="btn btn-info" href="{{ route(strtolower($model).'_create') }}">
                    <i class="fa fa-plus"></i>
                    {{ __('global.add') }}
                  </a>
                @endisGranted
              </div>
              <div class="clear"></div>
            </div>
            @show

            <!-- oubtou -->
            <div class="col-xs-12 col-md-12">
              <div class="table-responsive portlet_table_">
                @yield('content')

                <?php if( $results and $results->total() == 0 ){ ?>
                <div style="border: solid 1px #dcdcdc; border-top: none; margin: 0; padding: 25px;">
                  <div class="info-box-content" style="text-align: center;margin-left: 0;padding: 0;">
                    <span class="info-box-text">Aucun résultat</span>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>

            @section('paginate')
            <div class="box-footer col-xs-12 col-md-12" style="margin-top:  5px;">
              <div class="form-inline clearfix">
                <div class="pull-left col-xs-12 col-md-6 col-lg-6" style="padding-left: 5px;">
                  <div class="form-check" style="display: inline-block;">
                    <input type="checkbox" name="all_elements" id="all_elements">
                    <label for="all_elements" ></label>
                  </div>
                  <label for="all_elements" style="cursor: pointer;width: auto; height: auto" class="checkbox">
                    Tous les éléments
                  </label>
                  <select name="action" style="width: auto; height: auto" class="form-control">
                    <option value="delete">Supprimer</option>
                  </select>
                  <input type="submit" class="btn btn-small btn-primary delete_all_from_list" value="Supprimer">
                </div>
                <div class="pull-right col-xs-12 col-md-6 col-lg-6">
                  <div class="text-center">
                    @if($results){{ $results->links() }}@endif
                  </div> 
                </div>
              </div>
            </div>
            @show

          </div>
        </section>
      </div>
    </div>
  </div>
@endsection