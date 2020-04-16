@extends('standard')

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('reponse_update',$object->id) }}@else{{ route('reponse_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">
        @if($object->id)
          {{ __('reponse.reponse_edit') }}
        @else
          {{ __('reponse.reponse_create') }}
        @endif

      </h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('reponse.contenu') }}</label>
            <textarea class="form-control" name="contenu" id="contenu" cols="30" rows="10">@if($object->id){{ $object->contenu }}@else{{ old('contenu') }}@endif</textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('reponse.user_id') }}</label>
            <select class="form-control" id="user_id" name="user_id" required="">
              @foreach( $users as $user )
              <option value="{{ $user->id }}" @if($object->id && $object->user_id == $user->id ) selected="selected" @endif>{{ $user }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('reponse.question_id') }}</label>
            <select class="form-control" id="question_id" name="question_id" required="">
              @foreach( $questions as $question )
              <option value="{{ $question->id }}" @if($object->id && $object->question_id == $question->id ) selected="selected" @endif>{{ $question }}</option>
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