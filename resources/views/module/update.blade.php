@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('module_update',$object->id) }}@else{{ route('module_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">
        @if($object->id)
          {{ __('module.module_edit') }}
        @else
          {{ __('module.module_create') }}
        @endif

      </h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
      	</div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.ref') }}</label>
            <input class="form-control" id="ref" name="ref" value="@if($object->id){{ $object->ref }}@else{{ old('ref') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.filier_id') }}</label>
            <select class="form-control" id="filier_id" name="filier_id" required="">
              @foreach( $filiers as $filier )
              <option value="{{ $filier->id }}" @if($object->id && $object->filier_id == $filier->id ) selected="selected" @endif>{{ $filier }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('module.semester_id') }}</label>
            <select class="form-control" id="semester_id" name="semester_id" required="">
              @foreach( $semesters as $semester )
              <option value="{{ $semester->id }}" @if($object->id && $object->semester_id == $semester->id ) selected="selected" @endif>{{ $semester }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('module.description') }}</label>
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