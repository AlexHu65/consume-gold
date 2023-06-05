<section class="pt-5 pb-5" id="donar">
  <style media="screen">
  .card-wrapp{
    width: 250px !important;
    height: 250px !important;
  }
  .owl-carousel .owl-item .logo {
    display: block;
    width: 100%;
    height: 200px;
    object-fit: fill;
  }

  .owl-empresas .item {
    border-radius: 0 !important;
    overflow: hidden;
  }

  </style>
  <div class="container pb-5">
    <div class="d-sm-flex justify-content-center align-items-center">
      <div class="cta-join cta-2 advent d-sm-flex justify-content-left align-items-center">
        <div class="link p-2 text-left"><a href="{{url('catalogo')}}">QUIERO APOYAR</a></div>
        <div class="icon p-2 text-center">
          <a href="{{url('catalogo')}}">
            <img src="{{asset('images/icon-cta2.png')}}" alt="Quiero apoyar">
          </a>
        </div>
      </div>
    </div>
    <div class="text-donar">
      <h2 class="advent text-center font-weight-bold text-light">TRUEQUE / INTERCAMBIO</h2>
      <p class="text-center text-light">
        El intercambio es una práctica ancestral que se basa en los valores de la
        empatía, solidaridad y gentileza.
        <br>
        Hoy más que nunca,
        necesitamos regresar a otras fórmulas para impulsar nuestra economía.
        <br>
        <strong>
          Las siguientes empresas están listas para hacer trueque contigo.<br>
          <br>
          <span class="text-uppercase advent s30">¡comunicate con ellas!</span>
        </strong>
      </p>
      @if($intercambios)
      <div class="empresas">
        <div class="owl-carousel owl-empresas owl-theme">
          @foreach($intercambios as $establecimiento)
          @if($establecimiento->usuario->email_verified_at)
          <div class="item">
            <a href="{{url('negocio') . '/' . $establecimiento->id . '/' . $establecimiento->slug}}">
              <img class="logo" src="{{asset('storage') . '/' . ($establecimiento->logo ?  $establecimiento->logo->img : 'placeholder-logo.png') }}" alt="{{$establecimiento->nombre}}">
            </a>
            <a class="btn btn-danger s13 text-center text-light mt-4 w100" href="{{url('negocio') . '/' . $establecimiento->id . '/' . $establecimiento->slug}}">
              Hacer trueque
             </a>
            
          </div>          
          @endif
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>
</section>
