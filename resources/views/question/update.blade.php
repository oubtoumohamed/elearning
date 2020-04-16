@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('question_update',$object->id) }}@else{{ route('question_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">
        @if($object->id)
          {{ __('question.question_edit') }}
        @else
          {{ __('question.question_create') }}
        @endif

      </h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('question.titre') }}</label>
            <input class="form-control" id="titre" name="titre" value="@if($object->id){{ $object->titre }}@else{{ old('titre') }}@endif" type="text" required="">
          </div>
      	</div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('question.contenu') }}</label>
            <textarea class="form-control" name="contenu" id="contenu" cols="30" rows="10">@if($object->id){{ $object->contenu }}@else{{ old('contenu') }}@endif</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('question.photo') }}</label>
            @if($object->id){!! $object->getavatar() !!}@endif
            <input class="form-control" id="photo" name="photo" type="file">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('question.user_id') }}</label>
            <select class="form-control" id="user_id" name="user_id" required="">
              @foreach( $users as $user )
              <option value="{{ $user->id }}" @if($object->id && $object->user_id == $user->id ) selected="selected" @endif>{{ $user }}</option>
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