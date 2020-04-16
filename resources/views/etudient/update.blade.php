@extends('standard')

@section('content')
  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('etudient_update',$object->id) }}@else{{ route('etudient_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">
        @if($object->id)
          {{ __('etudient.etudient_edit') }}
        @else
          {{ __('etudient.etudient_create') }}
        @endif
      </h3>
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudient.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->getname() }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudient.email') }}</label>
            <input class="form-control" id="email" name="email" value="@if($object->id){{ $object->getemail() }}@else{{ old('email') }}@endif" type="email">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudient.password') }}</label>
            <input class="form-control" id="password" name="password" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudient.phone') }}</label>
            <input class="form-control" id="phone" value="@if($object->id){{ $object->getphone() }}@else{{ old('phone') }}@endif" name="phone" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudient.cin') }}</label>
            <input class="form-control" id="cin" value="@if($object->id){{ $object->getcin() }}@else{{ old('cin') }}@endif" name="cin" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudient.cne') }}</label>
            <input class="form-control" id="cne" value="@if($object->id){{ $object->getcne() }}@else{{ old('cne') }}@endif" name="cne" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('etudient.avatar') }}</label>
            @if($object->id){!! $object->getavatar() !!}@endif
            <input class="form-contro" id="avatar" name="avatar" type="file">
          </div>
        </div>
        <div class="row filier_module">

          <!-- Filiers -->
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">{{ __('etudient.filiers') }}</label>

              <div class="row" id="filiers_inscri">
                @php $student_filiers = [];  @endphp
                @if($object and $object->etudient_filiers)
                  @foreach ($object->etudient_filiers as $sf)
                    @php $student_filiers[$sf->filier_id] = $sf->filier_id;  @endphp  
                    <div class="filier_item">
                      <input name="old_filier[{{$sf->id}}]" value="{{$sf->id}}" type="hidden">
                        
                      <input class="form-control" name="new_filier[{{$sf->id}}][id]" type="hidden" value="{{ $sf->id }}">
                      <input class="form-control" name="new_filier[{{$sf->id}}][filier_id]" type="hidden" value="{{ $sf->filier_id }}">
                      <input class="form-control" name="new_filier[{{$sf->id}}][year]" type="hidden" value="{{ $sf->year }}">
                      <input class="form-control" name="new_filier[{{$sf->id}}][created_at]" type="hidden" value="{{ $sf->created_at }}">
                      <input class="form-control" name="new_filier[{{$sf->id}}][updated_at]" type="hidden" value="{{ date('y-m-d H:i:s') }}">


                      {{ $sf->year }} - {{ $sf->filier }}
                      <i class="fa fa-trash" onclick="delete_filier_item(this)"></i>
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="row affecttation">
                <b class="col-md-12">Affecter a une filier : </b>
                <div class="col-md-6">
                  <select class="form-control" id="filier" name="filier">
                  
                  @foreach($filiers as $filier)
                    @if( !in_array( $filier->id, $student_filiers ) )
                    <option value="{{ $filier->id }}">{{ $filier }}</option>
                    @endif
                  @endforeach
                  </select>
                </div>            
                <div class="col-md-4">
                  <input class="form-control" id="year" type="number" placeholder="Année : ">
                </div>
                <div class="col-md-2">
                  <button id="add_filier_item" type="button" class="btn btn-indigo">Ajouter</button>
                </div>
                <div class="clear"></div>
              </div>

            </div>
          </div>

          <!-- Modules -->

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">{{ __('etudient.modules') }}</label>


              <div class="row" id="modules_inscri">
                @php $student_modules = [];  @endphp              
                @if($object and $object->etudient_modules)
                  @foreach ($object->etudient_modules as $sf)
                    @php $student_modules[$sf->module_id] = $sf->module_id;  @endphp  
                    <div class="module_item">
                      <input name="old_module[{{$sf->id}}]" value="{{$sf->id}}" type="hidden">
                        
                      <input class="form-control" name="new_module[{{$sf->id}}][id]" type="hidden" value="{{ $sf->id }}">
                      <input class="form-control" name="new_module[{{$sf->id}}][module_id]" type="hidden" value="{{ $sf->module_id }}">
                      <input class="form-control" name="new_module[{{$sf->id}}][date_affect]" type="hidden" value="{{ $sf->date_affect }}">
                      <input class="form-control" name="new_module[{{$sf->id}}][created_at]" type="hidden" value="{{ $sf->created_at }}">
                      <input class="form-control" name="new_module[{{$sf->id}}][updated_at]" type="hidden" value="{{ date('y-m-d H:i:s') }}">


                      {{ $sf->date_affect }} - {{ $sf->module }}
                      <i class="fa fa-trash" onclick="delete_module_item(this)"></i>
                    </div>
                  @endforeach
                @endif
              </div>

              <div class="row affecttation">
                <b class="col-md-12">Affecter a une module :</b>
                <div class="col-md-6">
                  <select class="form-control" id="module" name="module">
                  
                  @foreach($modules as $module)
                    @if( !in_array( $module->id, $student_modules ) )
                    <option value="{{ $module->id }}">{{ $module }}</option>
                    @endif
                  @endforeach
                  </select>
                </div>  
                <div class="col-md-4">
                  <input class="form-control datepicker" id="date_affect" type="text" placeholder="Date : ">
                </div>
                <div class="col-md-2">
                  <button id="add_module_item" type="button" class="btn btn-indigo">Ajouter</button>
                </div>
                <div class="clear"></div>
              </div>

            </div>
          </div>
          <!-- / Modules -->
        </div>

      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        var ifilier = 1;
        $('#add_filier_item').click(function(){
          $filier_id = $('select#filier').val();
          $filier_text = $('select#filier option[value='+$filier_id+']').text();
          $created_at = "{{ date('y-m-d H:i:s') }}";
          $updated_at = "{{ date('y-m-d H:i:s') }}";
          $year = $('input#year').val();

          if( $year && $filier_id ){
            $('#filiers_inscri').append('<div class="filier_item new"> <input class="form-control" name="new_filier[new_'+ifilier+'][id]" type="hidden" value=""> <input class="form-control" name="new_filier[new_'+ifilier+'][filier_id]" type="hidden" value="'+$filier_id+'">  <input class="form-control" name="new_filier[new_'+ifilier+'][year]" type="hidden" value="'+$year+'">   <input class="form-control" name="new_filier[new_'+ifilier+'][created_at]" type="hidden" value="'+$created_at+'">   <input class="form-control" name="new_filier[new_'+ifilier+'][updated_at]" type="hidden" value="'+$updated_at+'"> '+$year +' - '+$filier_text+' <i class="fa fa-trash" onclick="delete_filier_item(this)"></i></div>');
            ifilier++;
          }
        });
      });
      function delete_filier_item(i){
        $(i).parent().remove();              
      }
      // for modules

      $(document).ready(function(){
        var imodule = 1;
        $('#add_module_item').click(function(){
          $module_id = $('select#module').val();
          $module_text = $('select#module option[value='+$module_id+']').text();
          $created_at = "{{ date('y-m-d H:i:s') }}";
          $updated_at = "{{ date('y-m-d H:i:s') }}";
          $date_affect = $('input#date_affect').val();

          if( $date_affect && $module_id ){
            $('#modules_inscri').append('<div class="module_item new"> <input class="form-control" name="new_module[new_'+imodule+'][id]" type="hidden" value=""> <input class="form-control" name="new_module[new_'+imodule+'][module_id]" type="hidden" value="'+$module_id+'">  <input class="form-control" name="new_module[new_'+imodule+'][date_affect]" type="hidden" value="'+$date_affect+'">   <input class="form-control" name="new_module[new_'+imodule+'][created_at]" type="hidden" value="'+$created_at+'">   <input class="form-control" name="new_module[new_'+imodule+'][updated_at]" type="hidden" value="'+$updated_at+'"> '+$date_affect +' - '+$module_text+' <i class="fa fa-trash" onclick="delete_module_item(this)"></i></div>');
            imodule++;
          }
        });
      });
      function delete_module_item(i){
        $(i).parent().remove();              
      }
    </script>
    <style type="text/css">
      .affecttation{
        background: #f2f2f2;
        border: solid 1px #ccc;
        padding: 10px 0;
        margin-bottom: 20px;
      }
      .affecttation b{
        display: block;
        margin-bottom: 10px;
        padding-top: 5px;
      }
      .filier_item ,
      .module_item {
        margin:5px 0;
        border: solid 1px #ccc; 
        border-left: solid 4px #ccc; 
        padding: 5px;
        background: #f0f0f0;
        width: 100%;
        height: 43px;
        line-height: 35px;
        font-weight: bold;
      } 
      .filier_item i ,
      .module_item i {
        width: 35px; 
        display: inline-block; 
        background: red; 
        padding: 5px 0; 
        text-align: center; 
        color: #fff; 
        float: right; 
        cursor: pointer; 
        font-size: 20px; 
      }
      .filier_module .form-group{
        padding: 20px
      }

      #modules_inscri,
      #filiers_inscri{
        height: 120px;
        overflow-y: scroll;
        display: block;
        margin-bottom: 10px;
        border: solid 1px #ccc;
        padding: 5px 10px;
      }
    </style>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection