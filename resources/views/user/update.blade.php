@extends('standard')

@section('content')
  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('user_update',$object->id) }}@else{{ route('user_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">
        @if($object->id)
          {{ __('user.user_edit') }}
        @else
          {{ __('user.user_create') }}
        @endif
      </h3>
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.name') }}</label>
            <input class="form-control" id="name" name="name" value="@if($object->id){{ $object->getname() }}@else{{ old('name') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.role') }}</label>
            @if($object->id)
            {{ $object->getrole() }}
            @else
            <select id="role" name="role" class="form-control select_with_filter">
              <option value="ETUDIENT" @if($object->id && $object->getrole() == "ETUDIENT" ) selected="selected" @endif >ETUDIENT</option>
              <option value="PROF" @if($object->id && $object->getrole() == "PROF" ) selected="selected" @endif >PROF</option>
              <option value="EMPLOYE" @if($object->id && $object->getrole() == "EMPLOYE" ) selected="selected" @endif >EMPLOYE</option>
              <option value="ADMIN" @if($object->id && $object->getrole() == "ADMIN" ) selected="selected" @endif >ADMIN</option>
            </select>
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.email') }}</label>
            <input class="form-control" id="email" name="email" value="@if($object->id){{ $object->getemail() }}@else{{ old('email') }}@endif" type="email">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.password') }}</label>
            <input class="form-control" id="password" name="password" value="" type="password">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.phone') }}</label>
            <input class="form-control" id="phone" value="@if($object->id){{ $object->getphone() }}@else{{ old('phone') }}@endif" name="phone" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.cin') }}</label>
            <input class="form-control" id="cin" value="@if($object->id){{ $object->getcin() }}@else{{ old('cin') }}@endif" name="cin" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.cne') }}</label>
            <input class="form-control" id="cne" value="@if($object->id){{ $object->getcne() }}@else{{ old('cne') }}@endif" name="cne" value="" type="text">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.avatar') }}</label>
            @if($object->id){!! $object->getavatar() !!}@endif
            <input class="form-contro" id="avatar" name="avatar" type="file">
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('user.groupes') }}</label>
            @php 
              $usergroupes = [];

              if($object and $object->groupes){
                foreach ($object->groupes as $ug) {
                  $usergroupes[$ug->id] = $ug->id;
                }
              }
            @endphp
            @foreach($groupes as $groupe)
              @php 
                if(in_array($groupe->id, $usergroupes))
                  $check_ = 'checked="checked"';
                else
                  $check_ = '';
              @endphp
              <div class="form-check checkbox_type">
                <input type="checkbox" {{ $check_ }} id="groupe{{$groupe->id}}" name="groupe[{{$groupe->id}}]" value="{{$groupe->id}}">
                <label for="groupe{{$groupe->id}}">{{$groupe->name}}</label>
              </div>
            @endforeach
          </div>
        </div>


      </div>
    </div>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection