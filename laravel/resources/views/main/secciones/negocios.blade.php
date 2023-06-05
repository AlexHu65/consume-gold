<section style="min-height: 800px;" class="pt-5 pb-5" id="panel">
  <div class="container-fluid">
    <div class="ui breadcrumb mt-3 mb-3">
      <a href="{{route('home')}}" class="section">Inicio</a>
      <span class="divider">/</span>
      <a href="{{url('catalogo')}}" class="{{isset($busqueda) ? '' : 'active'}} section">Negocios registrados</a>
      @if(isset($busqueda))
      <span class="divider">/</span>
      <a class="active section">Búsqueda: {{$string}}</a>
      @endif
    </div>

    <div class="pt-3 pb-3">
      Se muestran: <strong>{{$establecimientos->count()}}</strong> de <strong>{{$establecimientos->total()}}</strong>.
    </div>

    <div class="row">
      <div class="ui segment col-md-3">
        <form id="frmBusqueda" method="post" action="{{url('busqueda')}}" class="ui form">
          @csrf
          <div class="field">
            <div class="ui search">
              <div class="ui left icon input">
                <input name="txtBusqueda" class="prompt" type="text" placeholder="¿Qué estás buscando?">
                <i class="search icon"></i>
              </div>
              <div class="results"></div>
            </div>
          </div>
          <div class="ui divider"></div>
          <div class="title text-center">
            <i class="disabled filter icon"></i>
            <small><strong>Filtros</strong></small>
          </div>
          <div class="ui divider"></div>
          <div class="field">
            <div class="ui left icon input">
              <input name="txtCodigo" type="text" placeholder="Código postal">
              <i class="location arrow icon"></i>
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <input name="txtProducto" type="text" placeholder="¿Qué productos estás buscando?">
              <i class="location shopping basket icon"></i>
            </div>
          </div>
          
          <div class="field">
            <select name="txtCategoria[]" multiple="" class="ui fluid dropdown">
              <option value="">Categorías</option>
              @foreach($categorias as $categoria)
              <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
              @endforeach
            </select>
          </div>    
          <div class="field">            
            <div class="form-check">   
              
              <input {{isset($domicilio) ? 'checked' : ''}} class="form-check-input" type="checkbox" value="1" name="txtDomicilio" id="txtDomicilio">
              <label class="form-check-label" for="txtDomicilio">
                Cuenta con entrega a domicilio
              </label>
            </div>
          </div>      
          <button class="ui blue button w100" type="submit">Buscar</button>
          <div class="ui divider"></div>
          <button id="btnLimpiar" class="ui green button w100">Limpiar</button>
        </form>
        <div class="ui list">
          <div class="item">
            <i class="folder icon"></i>
            <div class="content">
              <div class="header">Categorías</div>              
              <div class="list">
                @foreach($categorias as $categoria)
                <div class="item">
                  <i class="tag icon"></i>
                  <div class="content">
                  <div class="header"><a class="hover" href="{{url('categoria/') . '/' . strtolower($categoria->nombre)}}">{{$categoria->nombre}}</a></div>                    
                  </div>
                </div>
                @endforeach
                
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="col-md-9">
        <div class="row">          
          @foreach($establecimientos as $establecimiento)
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
                    @if($establecimiento->logo)
                      <img style="height: 80px; border:2px solid rgba(207, 0, 15, 0.8);padding:3px;" class="ui tiny circular image" src="{{asset('storage/'). '/' .$establecimiento->logo->img}}">
                    @else
                    <img style="height: 80px; border:2px solid rgba(207, 0, 15, 0.8);padding:3px;" class="ui tiny circular image" src="{{asset('images/placeholder-fachada.jpg')}}">
                    @endif
                    <div class="pt-2">
                      <a class="hover" href="{{url('negocio') . '/' . $establecimiento->id . '/' . $establecimiento->slug}}">
                        <span>{{$establecimiento->nombre}}</span>
                      </a>
                      <br>
                      <a class="hover" target="_blank" href="https://www.google.com/maps/search/{{$establecimiento->calle . $establecimiento->numero}}">
                        <small>
                          <i class="map marker alternate icon"></i>{{$establecimiento->calle ." No.".  $establecimiento->numero}}
                        </small>
                      </a>                    
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
                        <a class="hover" href="{{url('categoria/') .'/'. strtolower($giro)}}">
                          <i class="tag icon"></i><small><strong>{{$giro}}</strong></small><br>
                        </a>
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
    <div class="d-flex justify-content-center">    
     
       {{$establecimientos->appends(request()->except('query'))->links() }}
    
    </div>
  </div>
</section>
