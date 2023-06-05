
<div class="col-md-12 d-sm-flex justify-content-around align-items-center">
    <ul class="list-inline d-sm-flex justify-content-around align-items-center">
        <li class="list-menu desk text-left"><a class="text-light advent s15" href="{{url('/')}}"><img style="width:60%;" src="{{asset('storage') . '/' . setting('site.logo')}}" alt="Consume GTO"></a></li>
        <li class="list-menu text-center"><a class="text-light advent s15" href="{{url('catalogo')}}">Negocios registrados</a></li>
        <!-- <li class="text-center"><a class="text-light advent s15" href="#">Quiero donar</a></li> -->
        <!-- <li class="text-center"><a class="text-light advent s15" href="#"></a></li> -->
        <li class="list-menu text-center"><a class="text-light advent s15" href="{{url('noticias')}}">Noticias</a></li>
        <li class="list-menu text-center"><a class="text-light advent s15" href="{{url('trueque')}}">Trueque</a></li>
        @if(empty($user))
        <li class="list-menu text-center"><a class="text-light advent s15" href="{{url('register')}}">Regístrate</a></li>
        @endif
        <li class="list-menu text-center"><a class="text-light advent s15" href="{{(!empty($user) ? url('dashboard') : url('login'))}}"><i class="far fa-user mr-2"></i>{{(!empty($user) ? 'Ver perfil' : 'Login')}}</a></li>
        @if(!empty($user))
        <li class="list-menu text-center"><a class="text-light advent s15" href="{{url('logout')}}"><i class="fas fa-times mr-2"></i>Salir</a></li>
        @endif
        {{-- <li class="list-inline-item"><a class="p-2" href="#"><img style="width:60%;" src="{{asset('images/facebook.png')}}" alt="Facebook"></a></li>
        <li class="list-inline-item"><a class="p-2" href="#"><img style="width:60%;" src="{{asset('images/instagram.png')}}" alt="Instagram"></a></li> --}}

    </ul>
</div>
