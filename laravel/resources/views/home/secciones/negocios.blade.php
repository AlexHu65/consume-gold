<section class="pt-5 pb-5 mb-5" id="negociosLista">
  <style media="screen">
  .card-wrapp{
    width: 250px !important;
    height: 250px !important;
  }
</style>
<div class="container">
  <div class="d-sm-flex justify-content-center align-items-center">
    <div class="cta-join advent d-sm-flex justify-content-left align-items-center">
      <div class="link p-2 text-left"><a href="{{url('registro')}}">QUIERO UNIRME</a></div>
      <div class="icon p-2 text-center">
        <a href="{{url('registro')}}">
          <img src="{{asset('images/icon-cta.png')}}" alt="Quiero unirme">
        </a>
      </div>
    </div>
  </div>
  <div class="d-sm-flex justify-content-center align-items-center flex-column">
    <div class="text-center montserrat pt-5 pb-5">
      Cualquier negocio o emprendedor puede ofrecer sus productos y servicios de manera gratuita.
      <br>
      Te indicamos paso a paso los datos que necesitas incluir
      <br>
      para darte de alta y formar parte de esta iniciativa.
    </div>
    <!-- form -->
    <div style="width:50%;" class="form-wrapper">
      <form method="post" action="{{url('busqueda')}}" id="srcForm" class="form-inline">
        @csrf
        <input style="border: none;border-bottom: 1px solid #dadfe1;" class="validate[custom[onlyLetterNumber]] browser-default no-radius form-control form-control-sm ml-3 w-75 " type="text" placeholder="Buscar negocios registrados."
        aria-label="Buscar" name="txtBusqueda">
        <span class="buscarBtn">
          <i class="ml-3 fas fa-search" aria-hidden="true"></i>
        </span>
      </form>
    </div>
    <div class="listado-negocios pt-5 pb-5">
      <h3 class="text-center active-red advent font-weight-bold pt-5 pb-5">NEGOCIOS REGISTRADOS</h3>
      <div class="row">
        @php
            $countNegocios = 0;
        @endphp
        @foreach($establecimientos as $establecimiento)                
        @if($establecimiento->usuario->email_verified_at && $establecimiento->logo)            
        
        <div class="col">
          <div>
            <div class="logo text-center pt-3 pb-3">
              <a href="{{url('/') . '/negocio/' . $establecimiento->id .'/' .$establecimiento->slug}}">
                <img style="height:150px;width:150px;" class="card-img-top" src="{{asset('storage') . '/' . ($establecimiento->logo ?  $establecimiento->logo->img : 'placeholder-logo.png') }}" alt="{{$establecimiento->nombre}}">
              </a>
            </div>
            <div class="body">
              <a href="{{url('/') . '/negocio/' . $establecimiento->id .'/' .$establecimiento->slug}}">
                <h2 class="hover text-uppercase card-title text-center">{{$establecimiento->nombre}}</h2>
              </a>
            </div>
          </div>
        </div>
        @php
            $countNegocios++;
            if($countNegocios == 5){
            break;
            }
        @endphp
        @endif        
        @endforeach
      </div>
    </div>
  </div>
</div>
</section>
