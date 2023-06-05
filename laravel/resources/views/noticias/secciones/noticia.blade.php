<section id="articulos" class="pt-3 pb-3 mb-5 articulo-detalle">
  <div class="container pt-5 pb-5">
    <div class="row">
      <div class="col-md-8">

        <div class="volver float-right p-3">
          <span class="uk-margin-small-right uk-icon" uk-icon="arrow-left"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" data-svg="arrow-left"><polyline fill="none" stroke="#000" points="10 14 5 9.5 10 5"></polyline><line fill="none" stroke="#000" x1="16" y1="9.5" x2="5" y2="9.52"></line></svg></span> <span>Volver</span>
        </div>
        <div class="texto">
          <h3 class="articulo-titulo-interior font-weight-bold">{{$noticias->titulo}}</h3>
          <div class="imagen">
            <img src="{{asset('storage') . '/' . $noticias->img}}" alt="{{$noticias->titulo}}">
          </div>
          <p><span style="font-size: 14px;">{!! $noticias->contenido !!}</span><br></p>
        </div>
        <div class="compartir">

        </div>

      </div>
      @if($nuevas->count() > 0)
        
      <div class="col-md-4">
        <div class="lo-mas-nuevo">
            <h4 class="font-weight-bold">Lo más nuevo</h4>
            <ul>
            @foreach($nuevas as $nueva)
                <li>
                <a href="{{url('noticias') .'/' . $nueva->slug}}">{{$nueva->titulo}}</a><br>                
                </li>
            @endforeach
            </ul>
        </div>        
      </div>
      @endif
    </div>
  </div>

</section>