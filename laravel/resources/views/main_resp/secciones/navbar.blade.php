<nav>
  <div class="nav-wrapper">
  <a href="{{url('/')}}" class="brand-logo"><img src="{{asset('images/logo.png')}}" alt=""></a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">

      <li class="advent"><a href="{{url('catalogo')}}">Negocios registrados</a></li>
      <li class="text-center"><a class="text-light advent s15" href="{{url('aviso-de-privacidad')}}">Aviso de privacidad</a></li>

      <!-- <li class="advent"><a href="#">Bolsa de trabajo</a></li>
      <li class="advent"><a href="#">Noticias</a></li> -->
      @if(!isset($user))
      <li class="advent"><a href="{{url('registro')}}">Registra tu negocio</a></li>
      <li class="advent"><a href="{{url('login')}}">Inicia sesión</a></li>
      @else
      <li class="text-center"><a class="text-light advent s15" href="{{(isset($user) ? url('dashboard') : url('login'))}}"><i class="far fa-user mr-2"></i>{{(isset($user) ? 'Ver perfil' : 'Login')}}</a></li>

      <li class="advent"><a href="{{url('logout')}}"><i class="material-icons left">close</i>Salir</a></li>
      @endif

    </ul>
  </div>
</nav>
<ul id="slide-out" class="sidenav">
  @if(isset($user))
  <li class="advent">
    <div class="user-view">
      <div class="background">
        <img src="{{asset('images/placeholder.png')}}">
      </div>
      @if($user->facebook)
      <a href="#user"><img class="circle" src="{{$user->avatar}}"></a>
      @else
      <a href="#user"><img class="circle" src="{{asset('storage') . '/' . $user->avatar}}"></a>
      @endif
      <a href="#name"><span class="white-text name">{{$user->name}}</span></a>
      <a href="#email"><span class="white-text email">{{$user->email}}</span></a>
    </div>
  </li>

  @endif
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
  @if(!isset($user))
  <li class="advent"><a href="{{url('login')}}" class="waves-effect"><i class="material-icons">perm_identity</i>Iniciar sesión</a></li>
  @else
  <li class="advent"><a href="{{url('dashboard')}}" class="waves-effect"><i class="material-icons">perm_identity</i>Perfil</a></li>
  @endif
  @if(isset($user))
  <li class="advent"><a href="{{url('dashboard/mi-negocio')}}" class="waves-effect"><i class="material-icons">label</i>Mi negocio</a></li>
  <!-- <li class="advent"><a href="#!" class="waves-effect"><i class="material-icons">favorite_border</i>Mis favoritos</a></li> -->
  @endif
  <li class="advent"><a href="#" data-target="slide-out" class="waves-effect"><i class="material-icons">blur_on</i>Más opciones</a></li>
</ul>



<ul class="sidenav" id="mobile-demo">
  <li class="advent"><a href="{{url('catalogo')}}"><i class="material-icons left">label</i>Negocios registrados</a></li>
  <!-- <li class="advent"><a href="#"><i class="material-icons left">work</i>Bolsa de trabajo</a></li>
  <li class="advent"><a href="#"><i class="material-icons left">dvr</i>Noticias</a></li> -->
  @if(!isset($user))
  <li class="advent"><a href="#"><i class="material-icons left">local_offer</i>Registra tu negocio</a></li>
  <li class="advent"><a href="{{url('login')}}"><i class="material-icons left">person</i>Inicia sesión</a></li>
  @else
  <li class="advent"><a href="{{url('logout')}}"><i class="material-icons left">close</i>Salir</a></li>

  @endif
</ul>
