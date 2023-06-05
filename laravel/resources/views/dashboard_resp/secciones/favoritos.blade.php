<section id="panel">
    <div id="wrapperPanel" class="container p-2 pt-5">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <!-- sidebar -->
          <div class="sidebar">
            @include('dashboard.secciones.sidebar')
          </div>
        </div>
        <div class="col-sm-12 col-md-8">
          <!-- content -->
          <div class="panel-content">
            <div class="text-left s13 pt-3 pb-3">
              <h2 class="active-red advent">FAVORITOS</h2>
            </div>
            <div class="content">
              <div class="row">
                @if($likes->count() > 0)
                    @foreach($likes as $l)
                        <?php    $establecimiento = App\Models\Establecimiento::where(['id' => $l->id_establecimiento])->first(); ?>
                        <div class="col-sm-12 col-md-6">

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
                    @endforeach
                @else
                <div class="col-sm-12 col-md-12">
                    <h3 class="advent">AÚN NO AGREGAS NADA A TU LISTA DE FAVORITOS</h3>

                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
