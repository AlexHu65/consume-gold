<section id="interior" class="mb-5">
  <style media="screen">
  .hover:hover{
    color: rgba(207, 0, 15, 1) !important;
    font-weight: bold !important;
  }
  #header{
    background: rgba(207, 0, 15, .8);
  }
  #interior{
    padding-top: 155px;
    height: auto !important;
  }
  /* Social Icons */
  .fb-color, .mess-color{
    border-radius: 0px !important;
  }
  #social_side_links {
    position: fixed;
    top: 150px;
    left: 0;
    padding: 0;
    list-style: none;
    z-index: 99;
  }

  #social_side_links li a {display: block;}

  #social_side_links li a img {
    display: block;
    max-width:40px;
    padding: 10px;
    -webkit-transition:  background .2s ease-in-out;
    -moz-transition:  background .2s ease-in-out;
    -o-transition:  background .2s ease-in-out;
    transition:  background .2s ease-in-out;
  }

  #social_side_links li a:hover img {background: rgba(0, 0, 0, .2);}
</style>
<div class="container">
  <div class="row p-5">
    <div class="col-md-12">
      <div  class="form-wrapper">
        <form method="post" action="{{url('busqueda')}}" id="srcForm" class="d-sm-flex justify-content-center form-inline">
          @csrf
          <i class="ml-3 fas fa-search" aria-hidden="true"></i>
          <input style="border: none;border-bottom: 1px solid #dadfe1;" class="validate[custom[onlyLetterNumber]] browser-default no-radius form-control form-control-sm ml-3 w-75 " type="text" placeholder="Seguir buscando..."
          aria-label="Buscar" name="txtBusqueda">

        </form>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- galeria -->
    <div class="col-sm-12 col-md-6">
      <div class="galeria">
        <div class="owl-galeria owl-carousel owl-theme">
          @if($interior->galeria)
          @foreach($interior->galeria as $gal)
          <div class="item">
            <a href="{{asset('storage') . '/' . $gal->img}}" data-fancybox="gallery" data-caption="{{$gal->caption}}">
              <img src="{{asset('storage') . '/' . $gal->img}}" alt="{{$gal->caption}}" />
            </a>
            <center class="p-3 active"><strong>{{$gal->caption}}</strong></center>
          </div>
          @endforeach
          @endif
        </div>
      </div>
      <div class="text-muted">Compartir en: <i class="fas fa-share"></i></div>
      <div class="d-flex mt-3 custom">

        <div class="icon-social  text-center p-2 text-light fb-color"><a target="_blank" href="https://www.facebook.com/share.php?u={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}&t=Consume local en {{$interior->nombre}} #ConsumeGTO."><i class="fab fa-facebook-f"></i></a></div>
        <div class="icon-social  text-center p-2 text-light twitter-color"><a target="_blank" href="https://twitter.com/intent/tweet?url={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}&text=Consume local en {{$interior->nombre}} #ConsumeGTO."><i class="fab fa-twitter"></i></a></div>
        <div class="icon-social text-center  p-2 text-light wa-color"><a target="_blank" href="https://api.whatsapp.com/send?text={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}"><i class="fab fa-whatsapp"></i></a></div>
        <div class="icon-social text-center  p-2 text-light mess-color"><a target="_blank" href="fb-messenger://share?link={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}"><i class="fab fa-facebook-messenger"></i></a></div>
      </div>
      <hr>
      <h2 class="advent s18 active-red">NUESTROS PRODUCTOS</h2>
      <div class="text-left">
        <?php
        $productos = json_decode($interior->lista_productos, true);
        foreach ($productos as $k => $v) {
          echo "<div style='font-size: 13px;padding: 5px;margin: 5px;text-transform: uppercase;' class='badge badge-danger'>".$v['value']."</div>";
        }
        ?>
      </div>
    </div>
    <!-- informacion del negocio  -->
    <div class="col-sm-12 col-md-6">
      <div style="background:url({{asset('storage') . '/' .  ($interior->fachada ?  $interior->fachada->img : 'placeholder-fachada.jpg')}});width: 100%;height: 250px;background-repeat: no-repeat;padding: 15px;background-size: cover;background-position: center;" class="content-fachada">
        <img style="height:84px;width: 84px;cursor:pointer;" class="circle logo-badge" src="{{asset('storage') . '/' . ($interior->logo ?  $interior->logo->img : 'placeholder-logo.png') }}">

      </div>

      <h2 class="advent active-red text-uppercase s18 mt-3">{{$interior->nombre}}</h2>
      <?php $arrayGiro = json_decode($interior->giro); ?>
      @foreach($arrayGiro as $giro)
      <span class="badge text-light badge-danger s13">{{$giro}}</span>
      @endforeach
      <p class="mt-3 mb-3">
        {{$interior->descripcion}}
      </p>
      <hr>
      <p class="mt-3">
        <strong> {{$interior->calle . ' #' . $interior->numero .' '. $interior->colonia}} </strong>  <br>
        <strong>{{$interior->ciudad}}</strong>.
        @if($interior->entre_calles)
        <strong>Entre calles {{$interior->entre_calles}}</strong>
        @endif

        @if($interior->interior)
        <strong>Interior {{$interior->interior}}</strong>
        @endif
        <br>
        <a class="hover" href="tel:{{$interior->telefono}}">
          {{$interior->telefono}}
        </a>
        <br>
        @if($interior->celular)
        <a class="hover" href="tel:{{$interior->celular}}">
          {{$interior->celular}}
        </a>
        <br>
        @endif
        <a class="hover" href="mailto:{{$interior->email}}">
          {{$interior->email_negocio}}

        </a>
        <br>
        @if($interior->entrega_domicilio)
        Contamos con entrega a domicilio
        @endif

      </p>
      <p>
        @if($interior->manos_guanajuato)
        <img style="width: 35%;"  src="{{asset('images/manos.png')}}">
        @endif
      </p>
      <!-- Social Icons -->
      <ul id="social_side_links">
        <li><a style="background-color: #3c5a96;color: white !important;padding:15px !important;" href="{{$interior->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
        <li><a style="background-color: #e95950;color: white !important;padding:15px !important;" href="{{$interior->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
        <li><a style="background-color: #3c5a96;color: white !important;padding:15px !important;" href="{{$interior->web}}" target="_blank"><i class="fas fa-globe-europe"></i></a></li>
      </ul>

    </div>
  </div>
</div>
</section>
<section id="related" class="relacionados">
  <div class="container">
    <div class="d-sm-flex justify-content-center align-items-center flex-column">

      <div class="listado-negocios pt-5 pb-5">
        <h3 class="text-center active-red advent font-weight-bold pt-5 pb-5">CERCANOS</h3>
        <div class="row row-cols-1 row-cols-md-3">
          @foreach($relacionado as $establecimiento)
          @if($establecimiento->usuario->email_verified_at)
          <div class="col-md-4 d-sm-flex justify-content-center align-items-center">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{asset('storage') . '/' . ($establecimiento->logo ?  $establecimiento->logo->img : 'placeholder-logo.png') }}" alt="{{$establecimiento->nombre}}">
              <div class="card-body">
                <h5 class="card-title">{{$establecimiento->nombre}}</h5>
                <p class="card-text">{!! \Illuminate\Support\Str::limit($establecimiento->descripcion , 155 , '...')!!}</p>
                <a href="{{url('/') . '/negocio/' . $establecimiento->id .'/' .$establecimiento->slug}}" class="float-right active-red">Ver Más</a>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>

</section>
