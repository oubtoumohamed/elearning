@extends('standard')

@section('content')

  <div class="card">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">
        {{ __('cours.titre') }} : <b>{{ $object->titre }}</b>
      </h3>
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <span class="tag tag-success">{{ $object->module }}</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <span class="tag tag-indigo">{{ $object->prof }}</span>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            <span class="tag">{{ $object->start }}</span>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <span class="tag">{{ $object->end }}</span>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-group">
            {!! $object->tagtype() !!}
          </div>
        </div>
      </div>

      <div class="selectgroup course_parts w-100">
        <label class="selectgroup-item">
          <input type="radio" name="desc_value" value="_contenu" checked="" class="selectgroup-input">
          <span class="selectgroup-button _contenu">{{ __('cours.contenu_part') }}</span>
        </label>
        <label class="selectgroup-item">
          <input type="radio" name="desc_value" value="_descussion" class="selectgroup-input">
          <span class="selectgroup-button _descussion">{{ __('cours.descussion_part') }}</span>
        </label>
        <label class="selectgroup-item">
          <input type="radio" name="desc_value" value="_quiz" class="selectgroup-input">
          <span class="selectgroup-button _quiz">{{ __('cours.quiz_part') }}</span>
        </label>
      </div>

      <div class="row div_course_parts course__contenu active">
        <div class="col-md-12">
          {!! $object->getcontenu() !!}
        </div>
        <div class="clear"></div>
      </div>


      <div class="row div_course_parts course__descussion">
        @if( $object->id )
        <div class="col-lg-12">
          <div class="card">
            <div class="card-bdy" >
              <ul class="list-group card-list-group card_messages" id="media-list-" style="min-height: 20vh;max-height: 70vh; overflow-y: scroll;">

                @if( $object->id and $object->questions )
                @foreach( $object->questions as $question )
                <li class="list-group-item py-5" id="Q{{ $question->id }}">
                  <div class="media">
                    <div class="media-object">
                      {!! $question->user->getavatar() !!}
                    </div>
                    <div class="media-body">
                      <div class="media-heading">
                        <small class="float-left text-muted">{{ $question->created_at }}</small>
                        <h5><b>{{ $question->user }}</b> [ #{{ $question->id }} ]</h5>
                      </div>
                      <div>
                        {!! $question->contenu !!}
                      </div>
                      <ul id="media-list-{{ $question->id }}" class="media-list" >
                        @foreach( $question->reponses as $reponse )
                        <li class="list-group-item py-5" id="Q{{ $reponse->id }}">
                          <div class="media">
                            <div class="media-object">
                              {!! $reponse->user->getavatar() !!}
                            </div>
                            <div class="media-body">
                              <div class="media-heading">
                                <small class="float-left text-muted">{{ $reponse->created_at }}</small>
                                <h5><b>{{ $reponse->user }}</b> [ #{{ $reponse->id }} ]</h5>
                              </div>
                              <div>{!! $reponse->contenu !!}</div>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                      <br>
                      <a href="javascript:replay({{ $question->id }})"  class="btn btn-square btn-secondary">
                        <i class="fa fa-reply" aria-hidden="true"></i>&nbsp;
                        {{ __('cours.question_replay') }}
                      </a>
                    </div>
                  </div>
                </li>
                @endforeach
                @endif

              </ul>
            </div>
            <div class="card-footer">
              <div class="input-group">
                <input type="hidden" id="question_id">
                <span id="question_text"></span>
                <textarea id="message" rows="2" class="form-control" placeholder="...."></textarea>
                <div class="input-group-append">
                  <button type="button" class="btn btn-info" id="sendQuestion">
                    <i class="fa fa-paper-plane"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){        
        $('.course_parts input').change(function(){
          $('.div_course_parts').removeClass('active');
          $('.course_'+ $(this).val()).addClass('active');
        });

        $('#sendQuestion').click(function(){
          $message = $('#message').val();
          $question_id = $('#question_id').val();
          $.ajax({
            method: "GET",
            url: "{{ route('etudient_cours_add_question', $object->id) }}",
            data: { 
              message: $message,
              question_id: $question_id
            }
          }).done(function( data ) {
            //alert( "Data Saved: " + msg );
            $('#media-list-'+$question_id).append(data['msg']);
            $('#message').val("");
            $('#question_text').text("");
            $('#question_id').val("");
            //$(".card_messages").scrollTop($('#Q'+data['id']).get(0).scrollHeight);

            //if( !$question_id )
            //console.log(data['id']);
            //$('html,body').animate({ scrollTop: $("#Q" + data['id']).offset().top }, 'slow');

            //console.log($('#media-list-'+$question_id).get(0).scrollHeight);
            if( !$question_id )
              $('.card_messages').animate({
                scrollTop:$('#media-list-'+$question_id).get(0).scrollHeight
              }, 2000);


            $('.list-group-item.active').animate({opacity:1},2000, function() {
              $( this ).removeClass( "active" );
            });

          });
        });

      });

      function replay($Qid){
        $('#question_text').text("{{ __('cours.question_replay') }} : #"+$Qid);
        $('#question_id').val($Qid);
        $('#message').focus();
      }
    </script>
    <style type="text/css">
      .div_course_parts:not(.active){display: none !important;} 
      .list-group-item.active{ background: #daeefc; }
    </style>
  </div>

@endsection