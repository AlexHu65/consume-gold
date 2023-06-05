<section id="interiorNegorio" class="mb-5">
  <!--portada-->
  <div class="portada">
    <div style="background:url({{asset('storage') . '/' .  ($interior->fachada ?  str_replace(' ', '%20', $interior->fachada->img) : 'banner-placeholder.jpg')}});width: 100%;height: 350px;background-repeat: no-repeat;padding: 15px;background-size: cover;background-position: center;background-attachment: fixed;" class="content-fachada">
      <img style="position: absolute;border:2px solid rgba(207, 0, 15, 0.8);padding:3px;height:150px;" class="ui small circular image" src="{{asset('storage') . '/' . ($interior->logo ?  $interior->logo->img : 'placeholder-fachada.jpg') }}">
      <button style="position: absolute;right:15px;" class="circular ui icon button red share">
        Compartir
        <i class="icon share alternate"></i>
      </button>
    </div>
  </div>
  <div class="container pt-5 pb-5">
    <div class="ui breadcrumb mt-3 mb-3">
      <a href="{{route('home')}}" class="section">Inicio</a>
      <span class="divider">/</span>
      <a href="{{url('catalogo')}}" class="section">Negocios registrados</a>
      <span class="divider">/</span>
      <a class="active section">{{$interior->nombre}}</a>
    </div>

    <div class="row">
      <div class="col-sm-12 col-md-4">
        <div class="ui segment contacto-section mb-3">
          <h4 class="ui header"><i class="text-muted mini circular phone icon"></i>Contacto e información</h4>
          <div class="ui divider"></div>
          <div class="data">
            @if(isset($interior->video_link))
            <div class="row mb-1">
              <div class="col">
                <iframe style="border:none;" width="100%" src="https://www.youtube-nocookie.com/embed/{{$interior->video_link}}?controls=0&rel=0&showinfo=0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
              </div>
            </div>
            @endif
            <div class="mt-3">
              <h2>{{$interior->nombre}}</h2>
              <div class="pt-2 pb-2">
                <a class="ui label">
                  <i class="heart red icon"></i> {{$likes->count()}}
                </a>
              </div>
              <p>
                {{$interior->descripcion}}
              </p>
              <p>
                <strong> {{$interior->calle . ' #' . $interior->numero .' '. $interior->colonia}} </strong>  <br>
                <strong>{{$interior->ciudad}}</strong>.
                @if($interior->entre_calles)
                <strong>Entre calles {{$interior->entre_calles}}</strong>
                @endif
                @if($interior->interior)
                <strong>Interior {{$interior->interior}}</strong>
                @endif
              </p>
              <p>
                <a class="hover" href="tel:{{$interior->telefono}}">
                  <div class="ui vertical animated button mb-3" tabindex="0">
                    <div class="hidden content">Llamar</div>
                    <div class="visible content">
                      <i class="phone icon"></i>{{$interior->telefono}}
                    </div>
                  </div>
                </a>
              </p>
              <p>
                @if($interior->celular)
                <a class="hover" href="tel:{{$interior->celular}}">
                  <div class="ui vertical animated button mb-3" tabindex="0">
                    <div class="hidden content">Llamar</div>
                    <div class="visible content">
                      <i class="mobile alternate icon"></i>{{$interior->celular}}
                    </div>
                  </div>
                </a>
              </p>
              @endif
              <p>
                @if($interior->email_negocio)
                <a class="hover" href="mailto:{{$interior->email_negocio}}">
                  <div class="ui vertical animated button" tabindex="0">
                    <div class="hidden content">Escribir</div>
                    <div class="visible content">
                      <i class="envelope outline icon"></i>{{$interior->email_negocio}}
                    </div>
                  </div>
                </a>
                @endif
              </p>
              @if($interior->galeria->count() > 0)
              <div class="data">
                <div class="ui divider"></div>
                <h3>Galería</h3>

                <div class="galeria">
                  <div class="owl-galeria owl-carousel owl-theme">
                    @if($interior->galeria)
                    @foreach($interior->galeria as $gal)
                    <div class="item">
                      <a href="{{asset('storage') . '/' . $gal->img}}" data-fancybox="gallery" data-caption="{{$gal->caption}}">
                        <img src="{{asset('storage') . '/' . $gal->img}}" alt="{{$gal->caption}}" />
                        <div class="text-center">
                          <small>{{$gal->caption}}</small>
                        </div>
                      </a>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
                <div class="ui divider"></div>
              </div>
              @endif
              <h3>Nuestras redes</h3>
              <div class="divider"></div>
              <div class="data">
                @if($interior->facebook)
                <a target="_blank" href="{{$interior->facebook}}">
                  <button class="ui circular facebook icon button">
                    <i class="facebook icon"></i>
                  </button>
                </a>
                @endif

                @if($interior->instagram)
                <a target="_blank" href="{{$interior->instagram}}">
                  <button class="ui circular red instagram icon button">
                    <i class="instagram icon"></i>
                  </button>
                </a>
                @endif

                @if($interior->web)
                <a target="_blank" href="{{$interior->web}}">
                  <button class="ui circular blue world icon button">
                    <i class="world icon"></i>
                  </button>
                </a>
                @endif
                @if($interior->whatsapp)
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+52{{$interior->whatsapp}}&text=Hola%20quer%C3%ADa%20ponerme%20en%20contacto%20contigo,%20te%20vi%20en%20consumeguanajuato.com">
                  <button class="ui circular whatsapp green icon button">
                    <i class="whatsapp icon"></i>
                  </button>
                </a>
                @endif
              </div>
              <div class="ui dn modal-share">
                <div class="content">
                  <a target="_blank" href="https://www.facebook.com/share.php?u={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}&t=Consume local en {{$interior->nombre}} #ConsumeGTO.">
                    <button class="ui circular facebook icon button">
                      <i class="facebook icon"></i>
                    </button>
                  </a>
                  <a target="_blank" href="https://twitter.com/intent/tweet?url={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}&text=Consume local en {{$interior->nombre}} #ConsumeGTO.">
                    <button class="ui circular twitter icon button">
                      <i class="twitter icon"></i>
                    </button>
                  </a>
                  <a target="_blank" href="fb-messenger://share?link={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}">
                    <button class="ui circular facebook messenger icon button">
                      <i class="facebook messenger icon"></i>
                    </button>
                  </a>
                  <a target="_blank" href="https://api.whatsapp.com/send?text={{url('/') . '/negocio/' . $interior->id . '/' . $interior->slug}}">
                    <button class="ui circular whatsapp green icon button">
                      <i class="whatsapp icon"></i>
                    </button>
                  </a>
                </div>
              </div>

              @if($interior->manos_guanajuato)
              <img class="ui tiny float-right circular image" src="{{asset('images/manos.png')}}">
              @endif

            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-8">
        <div class="ui segment contacto-section">
          <h4 class="ui header"><i class="text-muted mini circular shopping bag icon"></i>Productos y servicios</h4>
          <div class="ui divider"></div>
          <div class="row">
            @if(count($intProductos) > 0)
            @foreach($intProductos as $producto)
            <div class="col-4">
              <div class="ui card">
                <div class="image producto" id="producto_{{$producto->id}}">
                  <a class="ui left corner label votar_producto" data-id="{{$producto->id}}" data-tipo-voto="voto_negativo">
                    <i class="thumbs down outline icon red"></i>
                  </a>
                  <a class="ui right corner label votar_producto" data-id="{{$producto->id}}" data-tipo-voto="voto_positivo">
                    <i class="thumbs up outline icon blue"></i>
                  </a>
                  @if(isset($producto->fotos[0]))
                  <img src="{{asset($producto->fotos[0]->img)}}" alt="{{$producto->nombre}}">
                  @else
                  <img src="{{asset('storage') . '/' . 'placeholder-fachada.jpg'}}" alt="Imagen de producto">
                  @endif
                </div>
                <div class="content">
                  @if(isset($producto->fotos[0]))
                  @foreach($producto->fotos as $foto)
                  @if($loop->first)
                  <a class="header hover" href="{{asset($foto->img)}}" data-fancybox="galeria_{{$producto->id}}"
                    data-caption="{{$producto->descripcion}}">
                    {{$producto->nombre}}
                  </a>
                  @else
                  <a class="header d-none" href="{{asset($foto->img)}}" data-fancybox="galeria_{{$producto->id}}"
                    data-caption="{{$producto->descripcion}}"
                    ></a>
                    @endif
                    @endforeach
                    @else
                    <a class="header hover">{{$producto->nombre}}</a>
                    @endif
                    <div class="meta">
                      <span class="date">{{$interior->nombre}}</span>
                    </div>
                    <div class="description">
                      {{$producto->descripcion}}
                    </div>
                  </div>
                  <div class="extra content">
                    @if($producto->voto_positivo > 0)
                    <a>
                      <i class="heart icon"></i>
                      {{$producto->voto_positivo*100/($producto->voto_positivo + $producto->voto_negativo)}}% de usuarios gusta
                      de este producto
                    </a>
                    @else
                    <a>
                      <i class="eye slash icon"></i>
                      Este producto aún no recibe valoraciones
                    </a>
                    @endif
                  </div>
                </div>
              </div>
              @endforeach
              @else
              <div class="col-sm-12 col-md-12">
                <h3>Este establecimiento aún no tiene productos agregados :(</h3>
              </div>
              @endif
            </div>
            <div class="ui divider"></div>
            <div class="data">
              <?php
              $productos = json_decode($interior->lista_productos, true);
              foreach ($productos as $k => $v) {?>
                <a href="{{url('establecimientos/') . '/' . $v['value']}}" class="ui teal tag label m-2">{{$v['value']}}</a>
                <?php }
                ?>
              </div>
              <div class="ui divider"></div>
              <div class="data">
                <?php $arrayGiro = json_decode($interior->giro); ?>
                @foreach($arrayGiro as $giro)
                <a href="{{url('/categoria/') . '/' . $giro}}" class="ui tag label m-2">{{$giro}}</a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section style="min-height: 800px;" class="pt-5 pb-5" id="panel">
      <div class="container">
        <h1 class="text-center">Te puede interesar</h1>
        <div class="ui divider"></div>
        <div class="row pt-5 pb-5">
          <div class="col-md-12">
            <div class="row d-flex justify-content-center">
              @foreach($establecimientos as $establecimiento)
              <div class="col-md-4 pb-4 d-flex justify-content-center">
                <div class="ui card">
                  <div class="content">
                    <div class="header text-center">
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
                      <a href="{{url('negocio') . '/' . $establecimiento->id . '/' . $establecimiento->slug}}">
                        @if($establecimiento->logo)
                        <img style="height: 80px; border:2px solid rgba(207, 0, 15, 0.8);padding:3px;" class="ui tiny circular image" src="{{asset('storage/'). '/' .$establecimiento->logo->img}}">

                        @else
                        <img style="height: 80px; border:2px solid rgba(207, 0, 15, 0.8);padding:3px;" class="ui tiny circular image" src="{{asset('images/placeholder-fachada.jpg')}}">
                      </a>

                      @endif
                      <div class="pt-2">
                        <span>{{$establecimiento->nombre}}</span>
                        <br>
                        <small>
                          <i class="map marker alternate icon"></i>{{$establecimiento->calle ." No.".  $establecimiento->numero}}
                        </small>
                        <br>
                        <a class="hover" href="tel:{{$establecimiento->telefono}}">
                          <small>
                            <i class="phone alternate icon"></i>{{$establecimiento->telefono}}
                          </small>
                        </a>
                      </div>
                    </div>
                    <div class="description d-flex justify-content-center flex-column">
                      <p>
                        {!! \Illuminate\Support\Str::limit($establecimiento->descripcion , 200 , '...')!!}
                      </p>
                      <div class="ui divider"></div>
                      <p>
                        <?php $arrayGiro = json_decode($establecimiento->giro); ?>
                        @foreach($arrayGiro as $giro)
                        <i class="tag icon"></i><small><strong>{{$giro}}</strong></small><br>
                        @endforeach
                      </p>
                      <div class="link w100">
                        <a class="btn-more active-red font-weight-bold" href="{{url('negocio') . '/' . $establecimiento->id . '/' . $establecimiento->slug}}">
                          <div class="ui primary inverted animated button w100" tabindex="0">
                            <div class="visible content">Ver Más</div>
                            <div class="hidden content">
                              <i class="right arrow icon"></i>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="extra content d-flex justify-content-center">
                    <a target="_blank" href="https://www.facebook.com/share.php?u={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}&t=Consume local en {{$establecimiento->nombre}} #ConsumeGTO.">
                      <button class="ui circular facebook icon button">
                        <i class="facebook icon"></i>
                      </button>
                    </a>

                    <a target="_blank" href="https://twitter.com/intent/tweet?url={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}&text=Consume local en {{$establecimiento->nombre}} #ConsumeGTO.">
                      <button class="ui circular twitter icon button">
                        <i class="twitter icon"></i>
                      </button>
                    </a>

                    <a target="_blank" href="fb-messenger://share?link={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}">
                      <button class="ui circular facebook messenger icon button">
                        <i class="facebook messenger icon"></i>
                      </button>
                    </a>

                    <a target="_blank" href="https://api.whatsapp.com/send?text={{url('/') . '/negocio/' . $establecimiento->id . '/' . $establecimiento->slug}}">
                      <button class="ui circular whatsapp green icon button">
                        <i class="whatsapp icon"></i>
                      </button>
                    </a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- Go to www.addthis.com/dashboard to customize your tools -->
      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f1a37d07ca63282"></script>
    </section>
