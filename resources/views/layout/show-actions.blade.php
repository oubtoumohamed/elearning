@php
	$class = get_class($object);
	$path = explode('\\', $class);
  $object_class = array_pop($path);
@endphp

<div class="form-actions col-md-12 pull-center E_M_S_button">
  @isGranted('ROLE_'.strtoupper($object_class).'_EXPORT')
    <a id="exportpdf_btn" class="btn blue" target="_blank" 
    href="{{ route(strtolower($object_class).'_export',$object->id) }}">
    	<i class="fa fa-file-pdf-o"></i>{{ __('global.exportpdf') }}
    </a>
  @endisGranted
  @isGranted('ROLE_'.strtoupper($object_class).'_EDIT')
    <a id="edit_btn" class="btn green" href="{{ route(strtolower($object_class).'_edit',$object->id) }}">
    	<i class="fa fa-edit"></i>
    	{{ __('global.edit') }}
    </a>
  @endisGranted
  @isGranted('ROLE_'.strtoupper($object_class).'_DELETE')
    <a id="delete_btn" class="btn red" href="{{ route(strtolower($object_class).'_delete',$object->id) }}">
    	<i class="fa fa-trash"></i>{{ __('global.delete') }}
    </a>
  @endisGranted
  @isGranted('ROLE_'.strtoupper($object_class).'_ARCHIVE')
    <a id="archive_btn" class="btn purple" href="{{ route(strtolower($object_class).'_archive',$object->id) }}">
    	<i class="fa fa-archive"></i>{{ __('global.archive') }}
    </a>
  @endisGranted
</div>

