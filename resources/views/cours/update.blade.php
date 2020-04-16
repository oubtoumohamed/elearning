@extends('standard')

@section('head')
<!--script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script -->
<!--script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script-->

<script src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

<script>
 /*tinymce.init({
      selector: 'textarea#contenu',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });*/
/*
var editor = tinymce.init({
  selector: 'textarea#contenu',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  height: 400,
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link image imagetools table",
  relative_urls: false,
  file_picker_callback: function(callback, value, meta) {
    // Provide file and text for the link dialog
    /*if (meta.filetype == 'file') {
      callback('mypage.html', {text: 'My text'});
    }

    // Provide image and alt text for the image dialog
    if (meta.filetype == 'image') {
      callback('myimage.jpg', {alt: 'My alt text'});
    }

    // Provide alternative source and posted for the media dialog
    if (meta.filetype == 'media') {
      callback('movie.mp4', {source2: 'alt.ogg', poster: 'image.jpg'});
    }

    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

    var cmsURL = 'http://localhost/elearning/laravel-filemanager?field_name=';
    if (meta.filetype == 'image') {
      cmsURL = cmsURL + "&type=Images";
    } else {
      cmsURL = cmsURL + "&type=Files";
    }

   /* tinymce.activeEditor.windowManager.openUrl({
   title: 'Just a title',
   url: cmsURL
});


    tinymce.activeEditor.windowManager.openUrl({
      url : cmsURL,
      title : 'Filemanager',
      width : x * 0.8,
      height : y * 0.8,
      resizable : "yes",
      close_previous : "no"
    });

    

  }


 });*/



  var editor_config = {
    path_absolute : "{{ env('APP_URL', '') }}",
    selector: "textarea#contenu",
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media embed iframe fullpage | forecolor backcolor emoticons PDF POWERPOINT',
    /*audio_template_callback: function(data) {
     return 'lmkmlkjm <audio oubtou="lkjml" controls>' + '\n<source src="' + data.source1 + '"' + (data.source1mime ? ' type="' + data.source1mime + '"' : '') + ' />\n' + '</audio>';
   },*/
    media_url_resolver: function (data, resolve/*, reject*/) {
      if (
        data.url.indexOf('.ppt') !== -1 ||
        data.url.indexOf('.pptx') !== -1 ||
        data.url.indexOf('.pdf') !== -1 ||
        data.url.indexOf('.doc') !== -1 ||
        data.url.indexOf('.docx') !== -1 ||
        data.url.indexOf('.xls') !== -1 ||
        data.url.indexOf('.xlsx') !== -1
      ) {
        var url = data.url.replace('https://docs.google.com/gview?url=','');
        url = url.replace('&embedded=true','');
        var embedHtml = '<iframe datasrc="docs" src="https://docs.google.com/gview?url='+url+'&embedded=true" height="600px" width="100%" frameborder="0" class="ifrm"></iframe>';
        resolve({html: embedHtml});
      } else {
        resolve({html: ''});
      }
    },
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'File Manager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    },
    setup: function (editor) {
      editor.addButton('PDF', {
        text: 'PDF',
        icon: false,
        onclick: function() {
          editor.execCommand('mceMedia');

            /*var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=';
            if (type == 'image') {
              cmsURL = cmsURL + "&type=Images";
            } else {
              cmsURL = cmsURL + "&type=Files";
            }

            var aaa = tinyMCE.activeEditor.windowManager.open({
              file : cmsURL,
              title : '',
              width : x * 0.8,
              height : y * 0.8,
              resizable : "yes",
              close_previous : "no",
              onSubmit: function(e) {
                  // Insert content when the window form is submitted
                  editor.insertContent('Title: ' + e.data.title);
              }
            });*/
              /*var img = editor.selection.getNode();
              var ed = tinyMCE.activeEditor;
              var content = ed.selection.getContent({'format':'html'});
              var new_selection_content = '<a href="/' + img.src + '">' + content + '</a>';
              ed.execCommand('insertHTML', false, new_selection_content); */
        }
      });
      editor.addButton('POWERPOINT', {
        text: 'Power Point',
        icon: false,
        onclick: function() {
          editor.execCommand('mceMedia');
        }
      });
    },
  };
  tinymce.init(editor_config);

  function apply_editor(selector){
    var editor_config_textarea = {
      selector: selector,
       menubar:false,
    statusbar: false,
      plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
        'wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'save table contextmenu directionality emoticons template paste textcolor'
      ],
      content_css: 'css/content.css',
      toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link forecolor backcolor'
    };

    tinymce.init(editor_config_textarea);

  }
  apply_editor("textarea.QQUE_TEXTAREA");
  

</script>
@endsection

@section('content')

  <form class="card" method="POST" enctype="multipart/form-data" action="@if($object->id){{ route('cours_update',$object->id) }}@else{{ route('cours_store') }}@endif">
    {{ csrf_field() }}
    <div class="card-body">
      <h3 class="card-title">@if($object->id)
          {{ __('cours.cours_edit') }}
        @else
          {{ __('cours.cours_create') }}
        @endif
      </h3>

      @if( $object->id )
      <div class="selectgroup course_parts w-100">
        <label class="selectgroup-item">
          <input type="radio" name="desc_value" value="_contenu" {{ Request::get('part') && Request::get('part') != 'contenu' ? '' : 'checked=""' }}  class="selectgroup-input">
          <span class="selectgroup-button _contenu">{{ __('cours.contenu_part') }}</span>
        </label>
        <label class="selectgroup-item">
          <input type="radio" name="desc_value" {{ Request::get('part') == 'descussion' ? 'checked=""' : '' }} value="_descussion" class="selectgroup-input">
          <span class="selectgroup-button _descussion">{{ __('cours.descussion_part') }}</span>
        </label>
        <label class="selectgroup-item">
          <input type="radio" name="desc_value" {{ Request::get('part') == 'quiz' ? 'checked=""' : '' }} value="_quiz" class="selectgroup-input">
          <span class="selectgroup-button _quiz">{{ __('cours.quiz_part') }}</span>
        </label>
      </div>
      @endif

      <div class="row div_course_parts course__contenu {{ Request::get('part') && Request::get('part') != 'contenu' ? '' : 'active' }}">
        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('cours.titre') }}</label>
            <input class="form-control" id="titre" name="titre" value="@if($object->id){{ $object->titre }}@else{{ old('titre') }}@endif" type="text" required="">
          </div>
      	</div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('cours.module_id') }}</label>

            <select class="form-control select_with_filter" required="required" id="module_id" name="module_id">
            @foreach(auth()->user()->prof->modules as $module)
              <option value="{{ $module->id }}" @if($object->id && $object->module_id == $module->id ) selected="selected" @endif >{{ $module }}</option>
            @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('cours.type') }}</label>
            <select id="type" name="type" required="required" class="form-control select_with_filter">
              <option value="Cours" @if($object->id && $object->gettype() == "Cours" ) selected="selected" @endif >{{ __('cours.cours') }}</option>
              <option value="TP" @if($object->id && $object->gettype() == "TP" ) selected="selected" @endif >{{ __('cours.tp') }}</option>
              <option value="TD" @if($object->id && $object->gettype() == "TD" ) selected="selected" @endif >{{ __('cours.td') }}</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('cours.start') }}</label>
            <input class="form-control" id="start" name="start" value="@if($object->id){{ $object->start }}@else{{ old('start') }}@endif" type="text" required="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">{{ __('cours.end') }}</label>
            <input class="form-control" id="end" name="end" value="@if($object->id){{ $object->end }}@else{{ old('end') }}@endif" type="text" required="">
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="form-label">{{ __('cours.contenu') }}</label>
            <textarea class="form-control" rows="15" id="contenu" name="contenu">@if($object->id){{ $object->contenu }}@else{{ old('contenu') }}@endif</textarea>
          </div>
        </div>
      </div>


      <div class="row div_course_parts course__descussion {{ Request::get('part') == 'descussion' ? 'active' : '' }}">
        @if( $object->id )
        <div class="col-lg-12">
          <div class="card">
            <div class="card-bdy" >
              <ul class="list-group card-list-group card_messages" id="media-list-" style="height: 70vh; overflow-y: scroll;">

                @if( $object->id and $object->questions )
                @php $object->questions()->where([
                  ['user_id', '!=',$object->prof->user_id],
                  ['readed',null],
                ])->update(['readed' => 1]); @endphp
                @foreach( $object->questions as $question )
                <li class="list-group-item py-5 @if( $object->prof->user_id != $question->user_id ) readed_{{ $question->readed }} @endif" id="Q{{ $question->id }}">
                  <div class="media">
                    <div class="media-object">
                      {!! $question->user->getavatar() !!}
                    </div>
                    <div class="media-body">
                      <div class="media-heading">
                        <small class="float-left text-muted">{{ $question->created_at }}</small>
                        <h5><b>{{ $question->user }}</b> [ #{{ $question->id }} ]</h5>
                      </div>
                      <div> {!! $question->contenu !!} </div>
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


      <div class="row div_course_parts course__quiz {{ Request::get('part') == 'quiz' ? 'active' : '' }}">
        @if( $object->id )
        <div class="col-lg-12">
          <div class="card">
            <div class="card-bdy" id="quizquestions">
              @if( $object->id and $object->quizquestions )
              @foreach( $object->quizquestions as $QQUE )
                <div class="card card-question">
                  <div class="card-body">
                    <input name="QQUE[{{$QQUE->id}}][id]" type="hidden" value="{{ $QQUE->id }}">
                    <textarea class="form-control QQUE_TEXTAREA" name="QQUE[{{$QQUE->id}}][contenu]">{{ $QQUE->contenu }}</textarea>
                  </div>
                  <div class="card-footer">
                    <h3 class="card-title">{{ __("cours.responses_title") }} : <b>({{ __("cours.check_correct_reponses") }})</b></h3>
                    {!! $QQUE->build_reponses() !!}
                    <div class="clear"></div>
                  </div>
                </div>
              @endforeach
              @endif
            </div>
            <div class="card-footer addQuiz" style="background-color: #f5f7fb;">
              <b>{{ __('cours.new_quiz_question') }}</b><br/>
              <div class="input-group">
                <div class="input-group-append">
                  <span>{{ __('cours.new_quiz_question_type') }}</span>
                  <select id="new_QQUE_type">
                    <option value="true_false">{{ __('cours.true_false') }}</option>
                    <option value="single">{{ __('cours.single') }}</option>
                    <option value="multiple">{{ __('cours.multiple') }}</option>
                  </select>
                </div>
                <div class="input-group-append">
                  <span>{{ __('cours.new_quiz_question_number_reponses') }}</span>
                  <input id="new_QQUE_number" value="2" disabled="disabled" type="number" min="2" max="6">
                </div>
                <div class="input-group-append">
                  <button type="button" class="btn btn-info" id="SendQuizQuestion">
                    <i class="fa fa-plus"></i>
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
        var startDateTextBox = $('#start');
        var endDateTextBox = $('#end');

        /*$.timepicker.timeRange(
          startDateTextBox,
          endDateTextBox,
          {
            minInterval: (1000*60*60), // 1hr
            timeFormat: 'HH:mm',
            start: {}, // start picker options
            end: {} // end picker options
          }
        );*/

        $.timepicker.datetimeRange(
          startDateTextBox,
          endDateTextBox,
          {
            dateFormat : "yy-mm-dd", 
            timeFormat: 'HH:mm',
            minInterval: (1000*60*60), // 1 Hours
            maxInterval: (1000*60*60*8), // 8 Hours
            start: {}, // start picker options
            end: {}, // end picker options,
            //minDate: 0,
            //maxDate: 1
          }
        );
        
        $('.course_parts input').change(function(){
          $('.div_course_parts').removeClass('active');
          $('.course_'+ $(this).val()).addClass('active');
        });

        $('#sendQuestion').click(function(){
          $message = $('#message').val();
          $question_id = $('#question_id').val();
          $.ajax({
            method: "GET",
            url: "{{ route('cours_add_question', $object->id) }}",
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

        $('#new_QQUE_type').change(function(){
          if( $(this).val() == "true_false" )
            $('#new_QQUE_number').attr('disabled', 'disabled');
          else
            $('#new_QQUE_number').removeAttr('disabled', 'disabled');
        });

        QQUENBR = 1;
        $('#SendQuizQuestion').click(function(){
          $type = $('#new_QQUE_type').val();
          $number = $('#new_QQUE_number').val();

          $Qhtml = '<div class="card  card-question"> \
            <div class="card-body">\
              <input type="hidden" value="'+$type+'" name="QQUE[new_'+QQUENBR+'][type]"> \
              <textarea class="form-control QQUE" id="QQUE_'+QQUENBR+'_TEXTAREA" name="QQUE[new_'+QQUENBR+'][contenu]"></textarea> \
            </div> \
            <div class="card-footer"> \
              <h3 class="card-title">{{ __("cours.responses_title") }} : <b>({{ __("cours.check_correct_reponses") }})</b></h3>';

            if( $type == "true_false" )
              $number = 2;

            for( i=1; i<=$number; i++ ){

              $Qhtml += '<div class="item"> \
                <div class="input-group"> \
                  <span class="input-group-prepend"> \
                    <span class="input-group-text"> \
                      <input type="'+( $type == 'multiple' ? 'checkbox' : 'radio' )+'" value="'+i+'" '+( i==1 ? 'checked="checked"' : '' )+' name="QQUE[new_'+QQUENBR+'][reponses][correct]'+( $type == 'multiple' ? '['+i+']' : '' )+'" class="input-group-text"> \
                    </span> \
                  </span> \
                  <input type="text" name="QQUE[new_'+QQUENBR+'][reponses][data]['+i+']" class="form-control" value="choi '+i+'"> \
                </div> \
              </div>';

            }

          $Qhtml += '</div> \
          </div>';

          $('#quizquestions').append($Qhtml);
          apply_editor('textarea#QQUE_'+QQUENBR+'_TEXTAREA');
          QQUENBR ++;

        });

      });

      /*ClassicEditor
      .create( document.querySelector( '#contenu' ), {

          /*ckfinder: {
              uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
          }*
        } 
      )
      .catch( error => {
        console.error( error );
      });*/
      function replay($Qid){
        $('#question_text').text("{{ __('cours.question_replay') }} : #"+$Qid);
        $('#question_id').val($Qid);
        $('#message').focus();
      }
        /*var obja = {
    language : 'fr',
    //contentsCss : 'http://51.91.118.237/css/editor.css',
    toolbarGroups : [
      { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
      { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
      { name: 'forms', groups: [ 'forms' ] },
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
      { name: 'paragraph', groups: [ 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
      { name: 'links', groups: [ 'links' ] },
      { name: 'insert', groups: [ 'insert' ] },
      { name: 'styles', groups: [ 'styles' ] },
      { name: 'colors', groups: [ 'colors' ] },
      { name: 'tools', groups: [ 'tools' ] },
      { name: 'others', groups: [ 'others' ] },
      { name: 'about', groups: [ 'about' ] }
    ],
    removeButtons : 'Save,NewPage,Preview,Print,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,CopyFormatting,Superscript,Subscript,Outdent,Indent,CreateDiv,BidiLtr,BidiRtl,Language,JustifyRight,JustifyBlock,JustifyCenter,JustifyLeft,Anchor,Flash,Smiley,PageBreak,Styles,Font,ShowBlocks,About'
  };

  CKEDITOR.replace( 'contenu' , obja);*/

    </script>

    <style type="text/css">
      .div_course_parts:not(.active){display: none !important;} 
      .list-group-item.active{ background: #daeefc; }
      .card-question{margin: 1%;width: 98%;background-color: #f5f5f5;}
      .card-question .item{margin-bottom: 5px;}
      .card-question .card-body{padding: 10px; border: none;}
      .card-question .card-body .mce-container{border: none;}
      .addQuiz>b{display: block; }
      .addQuiz .input-group-append .select2-container{margin: 0 10px; min-width: 180px; }
      .addQuiz .input-group-append #new_QQUE_number{margin: 0 10px; }
      .addQuiz .input-group-append #SendQuizQuestion{width: 100px; }
      .readed_{background: #edf2fa; }
    </style>
    <div class="card-footer text-right">
      @include('layout.update-actions')
    </div>
  </form>

@endsection