<!doctype html>
<html lang="en">
<head>
  <meta name="google-site-verification" content="{{setting('site.google-site-verification')}}" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="{{setting('site.description')}}">
  <meta name="keywords" content="{{ setting('site.keywords')}}">
  <meta name="author" content="Difraxion">
  <meta name="robots" content="all">
  <meta name="geo.region" content="MX-GUA">
  <meta name="geo.placename" content="México">
  <meta name="DC.title" content="{{setting('site.title')}}">
  <meta property="og:image:alt" content="{{setting('site.title')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{setting('site.title')}}">
  <meta property="og:description" content="{{setting('site.description')}}">
  <meta property="og:image" content="{{asset('storage/' . setting('site.logo'))}}">
  <meta property="og:image:alt" content="{{setting('site.title')}}">
  <meta property="og:site_name" content="{{setting('site.nombre')}}">
  <meta property="og:url" content="{{setting('site.url')}}">
  <meta name="twitter:title" content="{{setting('site.title')}}">
  <meta name="twitter:description" content="{{setting('site.description')}}">
  <meta name="twitter:image" content="{{asset('storage/' . setting('site.logo'))}}">
  <meta name="robots" content="all">
  <meta name="copyright" content="Copyright (c) 2017">
  @include('partials.assets')
  <link rel="stylesheet" href="{{asset('css/mainApp.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href='{{asset('images/favicon.png')}}'/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <title> {{setting('site.title')}} - @yield('title') {{ setting('site.keywords')}}</title>
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
    <header id="header">
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
    <footer style="font-family:'Montserrat'" class="pt-5 pb-5">
      @include('partials.footer')
    </footer>
  </div>
  @include('partials.scripts')
</body>
</html>
