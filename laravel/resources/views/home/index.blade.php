@extends('master')
@section('title', 'Inicio')
@section('content')

<!-- banner -->
@include('home.secciones.banners')
<!-- listado de negocios  -->
@include('home.secciones.negocios')
<!-- quiero donar -->
@include('home.secciones.donar')
<!-- video -->
@include('home.secciones.video')
<!--noticias-->
@include('home.secciones.noticias')


@endsection
