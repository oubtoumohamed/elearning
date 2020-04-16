@extends('frontend.main')

@section('content') 

<!-- activities -->
<div class="row" id="about">
	<div class="headr">
		<h1 class="bloc-label">{{ __('global.about') }}</h1>
	</div>
	<div class="container">
		<div class="about-form">
        	<p class="col-md-4" style="text-align: right;padding-right: 10px;">
        	   <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" height="200px">
            </p>
            <p class="col-md-8">{{ __('global.site_description') }}</p>
            <div class="clear"></div>
        </div>
	</div>

    <div class="team">
        <h2>{{ __('global.team') }}</h2>
        <p>{{ __('global.team_text') }}</p>
        <div class="container">
            <div class="member">
                <img src="{{ asset('frontend/img/team/1.jpg') }}" alt="Aimad Aanibi">
                <h3>Aimad Aanibi</h3>
                <span>Director</span>
                <div class="member-contact">
                    <p><i class="fa fa-phone"></i>+212 6 25 68 29 73</p>
                    <p><i class="fa fa-envelope"></i>Aimad.Aanibi@gmail.com</p>
                </div>
                <div class="member-social">
                    <a class="fb" href="https://facebook.com/aimad.aanibiii" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a class="ins" href="https://www.instagram.com/aimadaanibi/" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a class="tw" target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="member">
                <img src="{{ asset('frontend/img/team/2.png') }}" alt="Aimad Aanibi">
                <h3>Yassine Benfettah</h3>
                <span>Director</span>
                <div class="member-contact">
                    <p><i class="fa fa-phone"></i>+212 6 72 98 27 30</p>
                    <p><i class="fa fa-envelope"></i>Yassine.Benfettah@gmail.com</p>
                </div>
                <div class="member-social">
                    <a class="fb" href="https://facebook.com/profile.php?id=100003275804839&amp;ref=content_filter"target="_blank"><i class="fa fa-facebook"></i></a>
                    <a class="ins" href="https://www.instagram.com/yassine.benfettah/" target="_blank"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="tw" target="_blank"><i class="fa fa-twitter"></i></a>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>

    </div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.navbar-custom ul li.about').addClass('active');
	});
</script>

<style type="text/css">
#about .headr{
    background-image: url('{{ asset('frontend/img/slider-1.jpg') }}');
    background-position: center bottom;
    background-size: cover;
    text-align: center;
}
#about .headr h1{
    background: rgba(0,0,0,0.4);
    padding: 8% 10%;
    margin: 0;
    color: #fff;
    font-weight: bold;
}
#about .container{
    padding: 5%;
}
.team{
  text-align: center;
  background: #f1f1f1;
  padding: 10px;
}
#about .team .container{
  padding: 20px;
}
#about .team .container .member{
  display: inline-block;
  text-align: left;
  background: #fff;
  margin: 10px;
}
#about .team .container .member:hover{
  box-shadow: 10px 10px 10px #ddd;
}
#about .team .container .member img{
  display: inline-block;
  height: 250px;
  width: 100%;  
}
#about .team .container .member h3{
  margin: 0;
  padding: 10px 10px 0 10px;
  border-right: solid 1px #ddd;
  border-left: solid 1px #ddd;
}
#about .team .container .member span{
  display: block;
  margin: 0;
  padding: 0 10px 10px 10px;
  color: #999;
  border-right: solid 1px #ddd;
  border-left: solid 1px #ddd;
}
#about .team .container .member .member-contact{
  padding: 10px;
  border-right: solid 1px #ddd;
  border-left: solid 1px #ddd;
}
#about .team .container .member .member-contact i{
  display: inline-block;
  color: var(--second-color);
  padding-right: 10px;
}
#about .team .container .member .member-social{
  padding: 0 10px 10px 10px;
  border-right: solid 1px #ddd;
  border-left: solid 1px #ddd;
  border-bottom: solid 1px #ddd;
}
#about .team .container .member .member-social a{
  text-align: center;
  color: #fff;
  float: left;
  width: 33.33%;
  padding: 10px;
  text-decoration: none;
  outline: none;
}
#about .team .container .member .member-social a.fb{
  background: #4267b2;
}
#about .team .container .member .member-social a.ins{
  background: #ef4d5c;
}
#about .team .container .member .member-social a.tw{
  background: #5dbced;
}






</style>


@endsection