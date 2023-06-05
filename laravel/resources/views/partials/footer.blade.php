<div class="container">
  <style media="screen">
  footer{
    background: #dc3922 !important;
  }
  .logo-footer{

  }
</style>
<div class="row">
  <div class="col-sm-12 col-md-3">
    <div class="logo-footer center">

      <img src="{{asset('images/logo-black.png')}}" alt="Consume Gto">

    </div>

  </div>

  <div class="col-sm-12 col-md-3">

    <ul>
      <li class="text-light s15 p-2"><a href="{{url('registro')}}">Registra tu negocio</a></li>
      <li class="text-light s15 p-2"><a href="{{url('catalogo')}}">Negocios registrados</a></li>
      <li class="text-light s15 p-2"><a href="{{url('dashboard')}}">Perfil</a></li>
      <li class="text-light s15 p-2"><a href="{{url('login')}}">Iniciar sesión</a></li>
      <li class="text-light s15 p-2"><a href="{{url('aviso-de-privacidad')}}">Aviso de privacidad</a></li>
      <!-- <li class="text-light font-weight-bold"></li>
      <li class="text-light font-weight-bold"></li>
      <li class="text-light font-weight-bold"></li> -->
    </ul>
  </div>

  <div class="col-sm-12 col-md-3">

    <h2 class="text-light center s18">CONTÁCTANOS</h2>
    <p class="center"><a class="text-light center" href="mailto:{{setting('site.correo')}}">{{setting('site.correo')}}</a></p>

  </div>
  <div class="col-sm-12 col-md-3 center">
    {{-- <a class="mr-3" target="_blank" href="{{setting('site.facebook')}}">
      <img src="{{asset('images/facebook-icon.png')}}" alt="Facebook">
    </a> --}}
    {{-- <a target="_blank" href="{{setting('site.instagram')}}">
        <img src="{{asset('images/instagram-icon.png')}}" alt="Instagram">
      </a> --}}
  </div>
</div>
<div class="divider"></div>
<div class="col">
  <div class="text-center text-light s15 pt-3">
    &copy; CONSUME GUANAJUATO , TODOS LOS DERECHOS RESERVADOS

  </div>
</div>
</div>
