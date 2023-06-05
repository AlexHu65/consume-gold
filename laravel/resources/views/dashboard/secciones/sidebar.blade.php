<ul class="list-group">
  <li class="list-group-item">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1 font-weight-bold">Mi perfil</h5>
    </div></li>
    <li class="list-group-item"><a class="text-muted {{(isset($active1) ?  'active-red' : '')}}" href="{{url('dashboard')}}"><span class="badge badge-pill badge-danger text-light text-center"><i class="far fa-user"></i></span>Información</a> </li>
    <li class="list-group-item"><a class="text-muted {{(isset($active2) ?  'active-red' : '')}}" href="{{url('dashboard/mi-negocio')}}"><span class="badge badge-pill badge-danger text-light text-center"><i class="fas fa-tag"></i></span>Mi negocio</a></li>
    <li class="list-group-item"><a class="text-muted {{(isset($active3) ?  'active-red' : '')}}" href="{{url('dashboard/mi-galeria')}}"><span class="badge badge-pill badge-danger text-light text-center"><i class="far fa-images"></i></span>Galería</a></li>
    <li class="list-group-item"><a href="{{url('negocio') . '/' . $negocio->id . '/' . $negocio->slug}}" class="text-muted {{(isset($active3) ?  'active-red' : '')}}" href="{{url('dashboard/mi-galeria')}}"><span class="badge badge-pill badge-danger text-light text-center"><i class="fas fa-home"></i></span>Ver mi espacio</a></li>
    <li class="list-group-item"><a class="text-muted {{(isset($active4) ?  'active-red' : '')}}" href="{{url('dashboard/mis-favoritos')}}"><span class="badge badge-pill badge-danger text-light text-center"><i class="far fa-heart"></i></span>Mis Favoritos</a></li>
    <li class="list-group-item"><a class="text-muted {{(isset($active5) ?  'active-red' : '')}}" href="{{url('dashboard/mis-productos')}}"><span class="badge badge-pill badge-danger text-light text-center"><i class="fa fa-shopping-bag"></i></span>Mis Productos</a></li>
</ul>
  <img class="w100" src="{{asset('images/seguimos.jpg')}}" alt="Seguimos adelante">
