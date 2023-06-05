@extends('master')
@section('title', 'Noticias')
@section('content')

<!-- banner -->
@include('home.secciones.banners')
<!-- listado de noticias  -->
@include('home.secciones.noticias')
<!-- quiero donar -->
@include('home.secciones.donar')
<!-- video -->
@include('home.secciones.video')
<!-- empresas/instituciones -->
@include('home.secciones.instituciones')


@endsection
