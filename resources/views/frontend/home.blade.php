@extends('frontend.main')
@section('content') 
<div class="row">
	<div id="booknow">
		<div class="container">
			<h1>{!! __('global.home_text') !!}</h1>
			<form class="" method="get" action="">
				<div class="col-md-4">
					<input type="text" name="title" placeholder="{{ __('global.home_text_holder') }}" class="title">
				</div>
				<div class="col-md-4">
					<select class="location" name="destination">
						<option value="">{{ __('global.all_destination') }}</option>
						<option value="Marrakech">Marrakech</option>
						<option value="Rabat">Rabat</option>
						<option value="Casa">Casa</option>
					</select>
				</div>
				<div class="col-md-4">
					<button class="submit">
						<i class="fa fa-search"></i>
						{{ __('global.search') }}
					</button>
				</div>
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>
<!-- feautreds -->
<div class="row" id="feautreds">
	<div class="container">
		<div class="col-md-4">
			<h1>
				<i class="fa fa-language"></i>
			</h1>
			<div class="descr">
				<h3>## Multi langes</h3>
				<p>Simple description ici ...</p>
			</div>
		</div>
		<div class="col-md-4">
			<h1>
				<i class="fa fa-usd"></i>
			</h1>
			<div class="descr">
				<h3>## Mini price</h3>
				<p>Simple description ici ...</p>
			</div>
		</div>
		<div class="col-md-4">
			<h1>
				<i class="fa fa-map-marker"></i>
			</h1>
			<div class="descr">
				<h3>## Destination</h3>
				<p>Simple description ici ...</p>
			</div>
		</div>
	</div>
</div>



@endsection