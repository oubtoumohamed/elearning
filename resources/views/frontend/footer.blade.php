<footer class="row footer">
  <div class="f1">
    <div class="col-md-3 description">
      <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" style="width: 120px;">
      <p>{{ __('global.site_description') }}</p>
    </div>
    <div class="col-md-3 contact">
      <h2 class="fw-title">{{ __('global.contact') }}</h2>
      <p><i class="fa fa-map-marker"></i>Marrakech</p>
      <p><i class="fa fa-phone"></i>+2126 25682973</p>
      <p><i class="fa fa-phone"></i>+212 672982730</p>
      <p><i class="fa fa-envelope"></i>info@marrakech-trip.com</p>
      <p><i class="fa fa-clock-o"></i>24/7 jours </p>
    </div>
    <div class="col-md-3 partenaires">
      <h2 class="fw-title">{{ __('global.partenaires') }}</h2>
      <p><a href="">Apple</a></p>
      <p><a href="">Samsung</a></p>
      <p><a href="">Tripadvisor</a></p>
      <p><a href="">Find My Guides</a></p>
    </div>
    <div class="col-md-3 subscribe">
      <h2 class="fw-title">{{ __('global.subscribe') }}</h2>
      <p>{{ __('global.subscribe_text') }}</p>
      <form class="footer-newslatter-form">
        <input type="text" placeholder="Email address">
        <button><i class="fa fa-send"></i></button>
      </form>    
      <div class="social">
        <a class="fb" href="https://facebook.com/profile.php?id=412542662812482"><i class="fa fa-facebook"></i></a>
        <a class="inst" href="https://www.instagram.com/marrakech.trip/"><i class="fa fa-instagram"></i></a>
        <a class="twi" href="#"><i class="fa fa-twitter"></i></a>
        <a class="trip" href="https://tripadvisor.com"><i class="fa fa-tripadvisor"></i></a>
      </div>
    </div>
    <div class="clear"></div>
  </div>

  <div class="clear"></div>

  <div class="rights">
    <div class="col-md-6 me">
      <a href="http://oubtou.com" target="_blank">Developed with <i class="fa fa-heart" style="color: #f00;"></i> by : Oubtou Mohamed</a>
    </div>
    <div class="col-md-6 he">
      {{ config('app.name') }} - {{ __('global.copyright') }} © {{ date('Y') }}
    </div>
    <div class="clear"></div>
  </div>
</footer>