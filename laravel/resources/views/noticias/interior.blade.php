@extends('master')
@section('title', $tituloSection)
@section('content')

<!-- banner -->
@include('home.secciones.banners')
<!-- noticia -->
@include('noticias.secciones.noticia')
<!-- quiero donar -->
@include('home.secciones.donar')
<!-- video -->
@include('home.secciones.video')
<!-- empresas/instituciones -->
@include('home.secciones.instituciones')


@endsection
