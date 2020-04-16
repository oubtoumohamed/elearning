<?php
	$class = get_class($object);
  $path = explode('\\', $class);
	$create_p__ = ( isset($create_params) ) ? $create_params : [];
	$object_class = array_pop($path);
	
?>

<button type="submit" id="save_btn" class="btn btn-success">
  <i class="fa fa-check"></i>&nbsp;
  {{ __('global.submit') }}
</button>

{{-- @if($object->id and isGranted('ROLE_'.strtoupper($object_class).'_CREATE  ') ) --}}
@if($object->id and isGranted($object_class) )
  <a id="create_btn" class="btn btn-primary" href="{{ route(strtolower($object_class).'_create',$create_p__) }}">
    <i class="fa fa-plus"></i>&nbsp;
    {{ __('global.add') }}
  </a>
@endif

@if($object->id and isGranted($object_class) )
  <a href="{{ route(strtolower($object_class).'_delete',$object->id) }}" type="button" data-toggle="modal" data-target="#confirmdelete" class="btn btn-danger delete_btn">
    <i class="fa fa-times"></i>&nbsp;
    {{ __('global.delete') }}
  </a>
@endif

{{-- @if($object->id and isGranted($object_class) )
  <a id="show_btn" class="btn btn-info" href="{{ route(strtolower($object_class).'_show',$object->id) }}">
  	<i class="fa fa-file-text-o"></i>&nbsp;
  	{{ __('global.show') }}
  </a>
@endif --}}

@if( isGranted($object_class) )
  <a id="list_btn" class="btn" href="{{ route(strtolower($object_class)) }}">
  	<i class="fa fa-ban"></i>&nbsp;
    {{ __('global.cancel') }}
  </a>
@endif

