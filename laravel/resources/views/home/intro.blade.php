<!doctype html>
<html style="background:black;" lang="en">
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
  <link rel='shortcut icon' type='image/x-icon' href='{{asset('images/favicon.png')}}'/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <title> {{setting('site.title')}}</title>
  <!--
  Este sitio ha sido desarrollado por Difraxion Group.
  Tel. +52 01 (477) 198 09 65
  E-mail: ventas@reed.com.mx
  www.difraxion.com
  León, Guanajuato
-->
<!-- analytics de google -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{setting('site.google_analytics_tracking_id')}}"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', '{{setting('site.google_analytics_tracking_id')}}');
</script>
<!-- <script src="http://maps.google.com/maps/api/js"></script> -->
<!-- <script src="{{asset('js/gmaps.js')}}"></script> -->
</head>
<body>
  
<div id="app">
    <div class="container">
      <div class="row">
        <div class="col">
          <div style="max-height: 1024px;display: flex;align-items: center;justify-content: center;" id="video_pattern">
            <video controls="true" style="max-height: 625px;display: flex;align-items: center;" id="video_background" class="vid" src="{{asset('images/tutorial.mp4')}}" muted autoplay="autoplay">
              <source src="{{asset('images/tutorial.mp4')}}" type="video/mp4">
              </video>
            </div>
            <div style="position: absolute; top:50%;" class="go-site text-center pt-2 pb-2">
              <a class="btn btn-info text-light" href="{{url('home')}}">IR AL SITIO</a>
            </div>

        </div>
      </div>
      
    </div>
      @include('partials.scripts')
      <script>        
          $("#video_background").prop('muted', false);
          $('#video_background').get(0).play();
      
      </script>
    </div>
@include('partials.scripts')
</body>
</html>
