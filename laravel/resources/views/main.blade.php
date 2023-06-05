<!doctype html>
<html id="mainApp" lang="en">
<head>
  <meta name="google-site-verification" content="{{setting('site.google-site-verification')}}" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="{{isset($descripcionInt) ? $descripcionInt : setting('site.description')}}">
  <meta name="keywords" content="{{ setting('site.keywords')}}">
  <meta name="author" content="Difraxion">
  <meta name="robots" content="all">
  <meta name="geo.region" content="MX-GUA">
  <meta name="geo.placename" content="México">
  <meta name="DC.title" content="{{(isset($tituloInt) ? $tituloInt : setting('site.title') )}}">
  <meta property="og:image:alt" content="{{(isset($tituloInt) ? $tituloInt : setting('site.title') )}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{(isset($tituloInt) ? $tituloInt : setting('site.title') )}}">
  <meta property="og:description" content="{{isset($descripcionInt) ? $descripcionInt : setting('site.description')}}">
  <meta property="og:image" content="{{isset($imgInt) ? asset('storage/' . $imgInt) : asset('storage/' . setting('site.logo'))}}">
  <meta property="og:image:alt" content="{{(isset($tituloInt) ? $tituloInt : setting('site.title') )}}">
  <meta property="og:site_name" content="{{setting('site.nombre')}}">
  <meta property="og:url" content="{{setting('site.url')}}">
  <meta name="twitter:title" content="{{(isset($tituloInt) ? $tituloInt : setting('site.title') )}}">
  <meta name="twitter:description" content="{{isset($descripcionInt) ? $descripcionInt : setting('site.description')}}">
  <meta name="twitter:image" content="{{isset($imgInt) ? asset('storage/' . $imgInt) : asset('storage/' . setting('site.logo'))}}">
  <meta name="robots" content="all">
  <meta name="copyright" content="Copyright (c) 2017">
  <!-- Etiquetas para Twitter-->
  <meta name="twitter:description" content="{{isset($descripcionInt) ? $descripcionInt : setting('site.description')}}">
  <meta name="twitter:title" content="{{(isset($tituloInt) ? $tituloInt : setting('site.title') )}}">
  <meta name="twitter:site" content="{{(isset($tituloInt) ? $tituloInt : setting('site.title') )}}">
  <meta name="twitter:image" content="{{isset($imgInt) ? asset('storage/' . $imgInt) : asset('storage/' . setting('site.logo'))}}">
  <meta name="twitter:creator" content="{{setting('site.title')}}">
  @include('main.secciones.assets')
  <link rel="stylesheet" href="{{asset('css/mainApp.css')}}">
  <link rel="stylesheet" href="{{asset('css/semantic.min.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href='{{asset('images/favicon.png')}}'/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <title> {{(isset($tituloInt) ? $tituloInt : setting('site.title') )}} - @yield('title') {{ setting('site.keywords')}}</title>
  <!--
  Este sitio ha sido desarrollado por Difraxion Group.
  Tel. +52 01 (477) 198 09 65
  E-mail: ventas@reed.com.mx
  www.difraxion.com
  León, Guanajuato
-->
<!-- analytics de google -->
</head>
<body>
  <div id="app">
    <header style="background: rgba(207, 0, 15, 0.8);">
      <div class="container">
        <div class="mov" id="cssmenu">
          <ul>
            @include('partials.menu')
          </ul>
        </div>
        <div class="desk desk-menu pt-1 pb-1">
          <div class="container">
            <div style="margin: 0px !important" class="row">
              @include('partials.deskmenu')
            </div>
          </div>
        </div>
      </div>
    </header>
    @yield('content')
  </div>
  @include('main.secciones.scripts')
  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('js/semantic.min.js')}}"></script>
  <script type="text/javascript">
  $(".share").on('click' , (e) =>{
    $(".modal-share").modal('show');
  });
</script>

</body>
</html>
