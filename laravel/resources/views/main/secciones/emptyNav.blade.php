<nav>
  <div class="nav-wrapper">
  <a href="{{url('/')}}" class="brand-logo"><img src="{{asset('images/logo.png')}}" alt=""></a>

    <a href="{{url('/')}}" class="d-xs-block d-md-none brand-logo"><img src="{{asset('storage/') . '/' . setting('site.logo')}}" alt=""></a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <li class="advent"><a href="{{url('catalogo')}}">Negocios registrados</a></li>
      <!-- <li class="advent"><a href="#">Bolsa de trabajo</a></li>
      <li class="advent"><a href="#">Noticias</a></li> -->
      <li class="advent"><a href="{{url('registro')}}">Registra tu negocio</a></li>
      <li class="advent"><a href="{{url('login')}}">Inicia sesión</a></li>

    </ul>
  </div>
</nav>
<ul id="slide-out" class="sidenav">
  <nav>
    <div class="nav-wrapper">
      <form method="post" action="{{url('busqueda')}}">
        @csrf
        <div class="input-field">
          <input id="search" type="search" name="txtBusqueda" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </div>
    </nav>
    <li class="advent"><div class="divider"></div></li>
  </form>
  <li class="advent"><a href="{{url('login')}}" class="waves-effect"><i class="material-icons">perm_identity</i>Iniciar sesión</a></li>

</ul>

<ul class="sidenav" id="mobile-demo">
  <li class="advent"><a href="{{url('catalogo')}}"><i class="material-icons left">label</i>Negocios registrados</a></li>
  <!-- <li class="advent"><a href="#"><i class="material-icons left">work</i>Bolsa de trabajo</a></li>
  <li class="advent"><a href="#"><i class="material-icons left">dvr</i>Noticias</a></li> -->
  <li class="advent"><a href="#"><i class="material-icons left">local_offer</i>Registra tu negocio</a></li>
  <li class="advent"><a href="{{url('login')}}"><i class="material-icons left">person</i>Inicia sesión</a></li>

</ul>
