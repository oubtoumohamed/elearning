@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('groupe_update',$object->id) }}@else{{ route('groupe_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">
        @if($object->id)
          {{ __('groupe.groupe_edit') }}
        @else
          {{ __('groue.groupe_create') }}
        @endif

      </h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('groupe.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->name }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('groupe.roles') }}</label>
            <select class="form-control" id="roles[]" name="roles[]" multiple="multiple">
              @foreach($object->get__roles() as $role=>$nm)
              <option value="{{ $role }}" @if( strpos( $object->roles.',' , $role.',' ) > -1 ) selected="selected" @endif >{{ $nm }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection