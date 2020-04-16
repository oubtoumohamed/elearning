@extends('standard')

@section('content')

<form method="POST" enctype="multipart/form-data" action="@if($object){{ route('user_update',$object->id) }}@else{{ route('user_store') }}@endif" class="card">
  {{ csrf_field() }}
  <div class="card-body">
    <h3 class="card-title">Edit Profile</h3>
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label class="form-label">Company</label>
          <input class="form-control" disabled="" placeholder="Company" value="Creative Code Inc." type="text">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="form-group">
          <label class="form-label">Username</label>
          <input class="form-control" placeholder="Username" value="michael23" type="text">
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="form-group">
          <label class="form-label">Email address</label>
          <input class="form-control" placeholder="Email" type="email">
        </div>
      </div>
      <div class="col-sm-6 col-md-6">
        <div class="form-group">
          <label class="form-label">First Name</label>
          <input class="form-control" placeholder="Company" value="Chet" type="text">
        </div>
      </div>
      <div class="col-sm-6 col-md-6">
        <div class="form-group">
          <label class="form-label">Last Name</label>
          <input class="form-control" placeholder="Last Name" value="Faker" type="text">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-label">Address</label>
          <input class="form-control" placeholder="Home Address" value="Melbourne, Australia" type="text">
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="form-group">
          <label class="form-label">City</label>
          <input class="form-control" placeholder="City" value="Melbourne" type="text">
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="form-group">
          <label class="form-label">Postal Code</label>
          <input class="form-control" placeholder="ZIP Code" type="number">
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label class="form-label">Country</label>
          <select class="form-control custom-select">
            <option value="">Germany</option>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group mb-0">
          <label class="form-label">About Me</label>
          <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Oh so, your weak rhymeYou doubt I'll bother, reading into itI'll probably won't, left to my own devicesBut that's the difference in our opinions.</textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-right">
    <button type="submit" class="btn btn-primary">Update Profile</button>
  </div>




<div class="tab-content">
  <div class="tab-pane active" id="tab_1_3">
    <div class="row profile-account">
      <div class="col-md-3">
        <ul class="ver-inline-menu tabbable margin-bottom-10">
          <li class="active"> 
            <a data-toggle="tab" href="#tab-infor" aria-expanded="false">
              <i class="fa fa-file-o"></i> {{ __('user.info') }}</a>
            <span class="after"> </span>
          </li>
          <li class="">
            <a data-toggle="tab" href="#tab_2-2" aria-expanded="false">
              <i class="fa fa-edit"></i>  {{ __('user.update_info') }}</a>
          </li>
          <li class="">
            <a data-toggle="tab" href="#tab_3-3" aria-expanded="false">
                <i class="fa fa-picture-o"></i> {{ __('user.change_image') }}  </a>
          </li>
          <li>
            <a data-toggle="tab" href="#tab_4-4" aria-expanded="true">
                <i class="fa fa-lock"></i>  {{ __('user.change_pw') }} </a>
          </li>
          <li class="">
            <a data-toggle="tab" href="#tab_5-5" aria-expanded="false">
                <i class="fa icon_Group"></i>  {{ __('user.gr') }} </a>
          </li>
        </ul>

        <div class=" light profile-sidebar-portlet ">
          <div class="profile-userpic">
            <div class="img-responsive" style="background-image: url('@if($object->avatar) {{ asset('storage/'.$object->picture->reference) }} @endif');width: 10em;height: 10em; background-size: contain; background-position: center;border-radius:50% !important;margin: 10px auto;border: solid 1px #e0eaf0;margin-top: 19px !important;background-repeat: no-repeat;">
            </div>
          </div>
          <div class="profile-usertitle">
            <div class="profile-usertitle-name" align="center"> <h4 style="color: #5a7391;"><b>{{ $object->__toString() }}</b></h4> </div>
            <div class="profile-usertitle-job" align="center"> <h6 style="color: #5b9bd1;"><b>{{ $object->job }}</b></h6> </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="tab-content">
          <div id="tab-infor" class="active tab-pane">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width:30%;"> <b>{{ __('user.lastname') }}</b> </td>
                    <td> {{ $object->lastname }} </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.firstname') }}</b> </td>
                    <td> {{ $object->firstname }} </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.job') }}</b> </td>
                    <td> {{ $object->job }} </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.gender') }}</b> </td>
                    <td> {{  __('user.gender'.$object->gender) }}  </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.email') }}</b> </td>
                    <td> {{ $object->email }} </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.phone') }}</b> </td>
                    <td> {{ $object->phone }} </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab_2-2" class="tab-pane">
            <div class="table-responsive">
              <table class="table table-bordered second_td_noborder">
                <tbody>
                  <tr>
                    <td style="width:30%;"> <b>{{ __('user.lastname') }}</b> </td>
                    <td>
                      <input id="lastname" type="text" class="form-control" name="lastname" value="@if($object){{ $object->lastname }}@else{{ old('lastname') }}@endif" required autofocus>
                      @if ($errors->has('lastname'))
                        <span class="help-block">
                          <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.firstname') }}</b> </td>
                    <td>
                      <input id="firstname" type="text" class="form-control" name="firstname" value="@if($object){{ $object->firstname }}@else{{ old('firstname') }}@endif" required >
                      @if ($errors->has('firstname'))
                        <span class="help-block">
                          <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.job') }}</b> </td>
                    <td>
                      <input id="job" type="text" class="form-control" name="job" value="@if($object){{ $object->job }}@else{{ old('job') }}@endif" required >
                      @if ($errors->has('job'))
                        <span class="help-block">
                          <strong>{{ $errors->first('job') }}</strong>
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td> <b class="required">{{ __('user.gender') }}</b> </td>
                    <td>
                      <div class="form-check radio_type">
                        <input id="genderM" type="radio" name="gender" value="M" @if($object and $object->gender == 'M'){{ 'checked="checked"' }}@endif>
                        <label for="genderM">{{ __('user.genderM') }}</label>
                        <input id="genderF" type="radio" name="gender" value="F" @if($object and $object->gender == 'F'){{ 'checked="checked"' }}@endif>
                        <label for="genderF">{{ __('user.genderF') }}</label>
                      </div>
                      @if ($errors->has('gender'))
                        <br>
                        <span class="help-block">
                          <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td> <b class="required">{{ __('user.email') }}</b> </td>
                    <td>
                      <input id="email" type="email" class="form-control" name="email" value="@if($object){{ $object->email }}@else{{ old('email') }}@endif" maxlength="254" pattern=".{2,}"  required >
                      @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.phone') }}</b> </td>
                    <td>
                      <input id="phone" type="text" class="form-control" name="phone" value="@if($object){{ $object->phone }}@else{{ old('phone') }}@endif" maxlength="254" pattern=".{2,}"  required >
                      @if ($errors->has('phone'))
                        <span class="help-block">
                          <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td> <b>{{ __('user.enabled') }}</b> </td>
                    <td>
                      <div class="form-check checkbox_type">
                        <input id="enabled" type="checkbox" name="enabled" value="1" @if($object and $object->enabled){{ 'checked="checked"' }}@endif>
                        <label for="enabled"></label>
                      </div>
                      @if ($errors->has('enabled'))
                        <br>
                        <span class="help-block">
                          <strong>{{ $errors->first('enabled') }}</strong>
                        </span>
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <style type="text/css">
            table.table.second_td_noborder{border: none !important;}
            table.table.second_td_noborder td:nth-child(2n){border: none !important;}
              .box__input
              {
                font-size: 1.25rem;
                position: relative;
                height: 200px;
                text-align: center;
                line-height: 200px;
                border: dashed 4px #169EF4;
              }
              .box__input  input
              {
                position: absolute;
                display: block;
                background: red;
                width: 100%;
                opacity: 0;
              }
          </style>

          <script type="text/javascript">

             jQuery(function ($) {
              function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                          
                         reader.readAsDataURL(input.files[0]);

                        reader.onload = function (e) {
                          var result_type = e.target.result.search('data:image/');
                            // var strings = input.files[0].name.toLowerCase();
                            // var ext_n = strings.substr(strings.lastIndexOf('.')+1);
                          if(result_type != -1){
                              $('#blah').show();
                              $('#blah').attr('src', e.target.result);
                              $('#label_drop').hide();
                          }else{
                              swal("Merci de choisir une image (.png ou .jpg)", "", "warning");
                          }
                        }
                        
                       
                    }
                }
                
                $("#avatar").change(function(){
                 
                    readURL(this);
              
                });
          });
          </script>

          <div id="tab_3-3" class="tab-pane">
            <div class="box__input">
              <input id="avatar" name="avatar" type="file" class="box__file">
              <img id="blah" style="display:none;" width="20%" src="">
              <label id="label_drop" for="file"><strong>Sélectionnez</strong>
                <span class="box__dragndrop"> ou déposez une image ici</span>.</label>
            </div>
            @if ($errors->has('avatar'))
              <span class="help-block">
                <strong>{{ $errors->first('avatar') }}</strong>
              </span>
            @endif
          </div>

          <script type="text/javascript">
            $(document).ready(function(){
              $('[data-toggle="tooltip"]').tooltip(); 
              $("#save_btn").click(function(e){
                if( $('#plainPassword').val() && ($('#plainPassword').val() == $('#Confirmation_plainPassword').val())){
                  e.preventDefault();
                  $('#formprofile').submit();
                }
                else if( $('#plainPassword').val() && ($('#plainPassword').val() != $('#Confirmation_plainPassword').val())){
                  e.preventDefault();
                  swal("Merci de vérifier le mot de passe", "", "warning");
                }
              });


              function check_pass($id,$class_parent,$children_class){
                $($id).parent().parent('.form-group').attr('class','form-group  '+$class_parent);
                $($id).parent().parent('.form-group').children().children('i').attr('class','fa tooltips '+$children_class);
              }


              $('#plainPassword').on('keypress keyup change',function(){
                var mdp1 = $(this).val();
                var mdp2 = $('#Confirmation_plainPassword').val();
                if (mdp2 != '') {
                  $('#Confirmation_plainPassword').val('');
                  check_pass('#Confirmation_plainPassword','has-success','');
                }
                if (mdp1 == '') {
                  check_pass('#plainPassword','','');
                }
              });
              $('#Confirmation_plainPassword').on('keypress keyup change',function(){
                var mdp2 = $(this).val();
                var mdp1 = $('#plainPassword').val();

                if (mdp2 != mdp1) {
                  check_pass('#Confirmation_plainPassword','has-error','fa-times');
                } else{
                  check_pass('#Confirmation_plainPassword','has-success','fa-check');
                }
                if (mdp2 == '') {
                  check_pass('#Confirmation_plainPassword','','');
                }
              });
            });
          </script>

          <div id="tab_4-4" class="tab-pane">


            <div class="form-group">
              <label class="control-label">{{ __('user.password') }}</label>
              <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}" >
              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <label class="control-label">{{ __('user.password_confirmation') }}</label>
              
              <div class="input-icon right">
                <i class="fa tooltips" data-original-title="Les mots de passe ne correspondent pas. Voulez-vous réessayer ?" data-container="body"></i>
                <input id="password_confirmation" type="text" class="form-control" name="password_confirmation" value="">
                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div> 

          <div id="tab_5-5" class="tab-pane">
            <div class="form-group">
              <h3 class="control-label">{{ __('user.groupe') }}</h3>
              <ul>                
                <?php
                  foreach ($object->groupes as $groupe) {
                    echo "<li><b>". $groupe->name. "</b></li>";
                  }
                ?>
              </ul>

            </div>
          </div>
        </div>
      </div>

      <div class="clear"></div>

      <br>

    </div>
  </div>
</div>
</form>

 
@endsection