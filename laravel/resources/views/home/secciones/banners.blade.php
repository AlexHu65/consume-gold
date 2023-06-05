<section class="desk d-xs-none d-md-block">
    <div class="owl-banner owl-carousel owl-theme d-none d-md-block z-0">
        @foreach($banners as $banner)
        <div class="item">    
      {{-- <div class="uk-position-left uk-overlay uk-overlay-default uk-flex uk-flex-middle">Left</div> --}}

            <img src="{{asset('storage/') .'/'. $banner->img}}" alt="Consume guanajuato">
            <div class="main-header text-center w100 absolute text-light animated bounceInLeft delay-2s">
                <div class="logo-header">
                    <img style="width:50%" src="{{asset('images/logo-inverse.png')}}" alt="Consume Guanajuato">
                </div>
                <div class="title-header">
                    <h1 class="advent text-light font-weight-bold text-left">
                        {{isset($tituloSection) ? $tituloSection : 'HAZLO LOCAL'}}
                    </h1>
                    <div class="text-left">
                        {{isset($contenidoHead) ? $contenidoHead : $banner->descripcion}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
      </div>


</section>
<section class="dekMov mov pb-5">
  <div class="d-sm-flex justify-content-center align-items-center">
    <div class="logo-m p-5">
      <img src="{{asset('storage') . '/' .setting('site.logo')}}" alt="Logo consume Guanajuato">

    </div>
    <div class="title-m p-2">
      <h2 class="advent text-center font-weight-bold s30 text-light" style="margin:10px 0px;">{{isset($tituloSection) ? $tituloSection : 'HAZLO LOCAL'}}</h2>
    </div>
    <div class="descripcion-m p-2">

      <p style="line-height:1;" class="text-justify" uk-slideshow-parallax="x: 200,-200">{{isset($contenidoHead) ? $contenidoHead : $banner->descripcion}}</p>
  </div>
  </div>
</section>
