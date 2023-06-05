@extends('main')
@section('title', 'Búsqueda')
@section('content')

<!-- banner -->
@include('main.secciones.banner')
<!-- listado de negocios  -->
@include('main.secciones.search')
<!-- quiero donar -->
@include('home.secciones.donar')
@endsection
