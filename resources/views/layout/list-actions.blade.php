@php
	$class = get_class($object);
	$path = explode('\\', $class);
    $object_class = array_pop($path);
@endphp
<div class="list-actions">
	@isGranted('ROLE_'.strtoupper($object_class).'_SHOW')
		<a href="{{ route(strtolower($object_class).'_show',$object->id) }}"><i class="fa fa-eye"></i></a>
	@endisGranted
	@isGranted('ROLE_'.strtoupper($object_class).'_EDIT')
		<a href="{{ route(strtolower($object_class).'_edit',$object->id) }}"><i class="fa fa-edit"></i></a>
	@endisGranted
	<br>
	@isGranted('ROLE_'.strtoupper($object_class).'_DELETE')
		<a href="{{ route(strtolower($object_class).'_delete',$object->id) }}"  type="button" data-toggle="modal" data-target="#confirmdelete" class="btn btn-danger delete_btn"><i class="fa fa-trash"></i></a>
	@endisGranted
	@isGranted('ROLE_'.strtoupper($object_class).'_ARCHIVE')
		<a href="{{ route(strtolower($object_class).'_archive',$object->id) }}"><i class="fa fa-archive"></i></a>
	@endisGranted
</div>