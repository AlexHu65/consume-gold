@extends('appMaster')
@section('title', 'Registra tu negcio')
@section('content')
<!-- formulario -->
@if(isset($thank))
  @include('registro.secciones.thankyou')
@else
  @include('registro.secciones.formulario')

@endif
@endsection
