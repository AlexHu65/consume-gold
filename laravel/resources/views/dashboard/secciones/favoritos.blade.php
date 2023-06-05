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
                        <div class="col-md-4 pb-4">
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
                                  
                                  <div class="ui divider"></div>
                                  <p>
                                    <?php $arrayGiro = json_decode($establecimiento->giro); ?>
                                    @foreach($arrayGiro as $giro)
                                    <i class="tag icon"></i><small><strong>{{$giro}}</strong></small><br>
                                    @endforeach
                                  </p>
                                </div>
                              </div>
                              
                          </div>
                      </div>
                    @endforeach
                @else
                <div class="col-sm-12 col-md-12">
                    <h3 class="advent">AÚN NO AGREGAS NADA A TU LISTA DE FAVORITOS</h3>

                </>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
