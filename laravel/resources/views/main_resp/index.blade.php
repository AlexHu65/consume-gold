@extends('main')
@section('title', 'Consume GTO')
@section('content')

<!-- banner -->
@include('main.secciones.banner')
<!-- listado de negocios  -->
@include('main.secciones.negocios')
<!-- quiero donar -->
@include('home.secciones.donar')
<!-- instituciones -->
@include('home.secciones.instituciones')
<!-- noticias -->
@include('home.secciones.noticias')

@endsection
