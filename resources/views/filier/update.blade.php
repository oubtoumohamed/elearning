@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('filier_update',$object->id) }}@else{{ route('filier_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">@if($object->id)
          {{ __('filier.filier_edit') }}
        @else
          {{ __('filier.filier_create') }}
        @endif
</h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('filier.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
      	</div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('filier.description') }}</label>
            <textarea class="form-control" id="description" name="description">@if($object->id){{ $object->description }}@else{{ old('description') }}@endif</textarea>
          </div>
        </div>
        
      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection