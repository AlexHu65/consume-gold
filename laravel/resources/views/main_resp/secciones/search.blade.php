<section class="pt-5 pb-5" id="panel">
  <div class="d-sm-flex justify-content-center align-items-center">
    <div class="cta-join advent d-sm-flex justify-content-left align-items-center">
      <div class="link p-2 text-left"><a href="">QUIERO UNIRME</a></div>
      <div class="icon p-2 text-center">
        <a href="{{url('registro')}}">
          <img src="{{asset('images/icon-cta.png')}}" alt="Quiero unirme">
        </a>
      </div>
    </div>
  </div>
<div class="container">

  <div class="row">
    <div class="col">
      <div>
        <form method="post" id="srcForm" action="{{url('busqueda')}}">
          @csrf
          <div class="row">
            <div class="input-field col s12 text-dark">
              <i class="material-icons prefix">search</i>
              <input type="text" id="autocomplete-input" name="txtBusqueda" class="autocomplete">
              <label class="label-custom" for="autocomplete-input">Calle, nombre de negocio, giro, código postal</label>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

  <h2 class="text-center font-weight-bold s25 advent active-red">RESULTADO DE LA BÚSQUEDA: {{$busqueda}}</h2>
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="row">
          @foreach($establecimientos as $establecimiento)
          @if($establecimiento->usuario->email_verified_at)
          <div class="col-sm-12 col-md-3">
            <div class="card">
                <div class="card-image">
                    @if(!empty($user))
                    <?php
                    $like = App\Models\Like::where(['id_usuario' => $user->id ,'id_establecimiento' => $establecimiento->id])->get();
                    ?>
                      @if($like->count() > 0)
                          @foreach($like as $l)
                          <i data-like="{{$l->id}}" data-user="{{(isset($user) ? $user->id : '')}}" data-loved="{{($establecimiento->id == $l->id_establecimiento ? 'true' : 'false')}}" data-id="{{$establecimiento->id}}" class="icon-heart {{($establecimiento->id == $l->id_establecimiento ? 'icon-heart--clicked' : '')}}"></i>
                          @endforeach
                      @else
                        <i data-user="{{(isset($user) ? $user->id : '')}}" data-loved="false" data-id="{{$establecimiento->id}}" class="icon-heart"></i>

                      @endif
                    @endif
                  @if($establecimiento->logo)
                  <img src="{{asset('storage/'). '/' .$establecimiento->logo->img}}">
                  @else
                  <img src="{{asset('images/placeholder-fachada.jpg')}}">
                  @endif
                </div>
              <div class="card-content">
                <span class="card-title activator grey-text text-darken-4 text-uppercase s13">{{$establecimiento->nombre}}<i class="material-icons right">more_vert</i></span>
                <!-- <p>{{$establecimiento->descripcion}}</p> -->
                <p><a class="btn-more active-red font-weight-bold" href="{{url('negocio') . '/' . $establecimiento->id . '/' . $establecimiento->slug}}">Ver Más</a></p>
              </div>
              <div class="card-reveal">
                <div class="row">
                  <img style="height:84px;cursor:pointer;" class="circle logo-badge" src="{{asset('storage') . '/' . ($establecimiento->logo ?  $establecimiento->logo->img : 'placeholder-logo.png') }}">
                </div>
                <span class="card-title grey-text text-darken-4 text-uppercase s13">{{$establecimiento->nombre}}<i class="material-icons right">close</i></span>
                <p style="font-size: 14px;line-height: 1;">{{$establecimiento->descripcion}}</p>
                <p style="font-size: 14px;line-height: 1;">{{$establecimiento->calle . ' ' . ' #' . $establecimiento->numero . ' ' . $establecimiento->colonia}} , {{$establecimiento->codigo_postal}}</p>

                <small class="text-muted">Compartir en: <i class="fas fa-share"></i></small>
                <div class="d-sm-flex">
                    <div class="icon-social  text-center p-2 text-light fb-color"><a target="_blank" href="https://www.facebook.com/share.php?u={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}&t=Consume local en {{$establecimiento->nombre}} #ConsumeGTO."><i class="fab fa-facebook-f"></i></a></div>
                    <div class="icon-social  text-center p-2 text-light twitter-color"><a target="_blank" href="https://twitter.com/intent/tweet?url={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}&text=Consume local en {{$establecimiento->nombre}} #ConsumeGTO."><i class="fab fa-twitter"></i></a></div>
                    <div class="icon-social text-center  p-2 text-light wa-color"><a target="_blank" href="https://api.whatsapp.com/send?text={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}"><i class="fab fa-whatsapp"></i></a></div>
                    <div class="icon-social text-center  p-2 text-light mess-color"><a target="_blank" href="fb-messenger://share?link={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}"><i class="fab fa-facebook-messenger"></i></a></div>
                </div>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>

  </div>
  <!-- <div id="wrapperPanel" class="container p-5 mt-5">
  <div class="container"> -->

  <!-- </div>
</div> -->
</section>
