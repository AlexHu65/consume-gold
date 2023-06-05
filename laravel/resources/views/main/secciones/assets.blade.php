<script type="text/javascript">
    // variable base para javascript
    var url = '{{config('app.url')}}';
    var user  = '{{isset($user) && (!empty($user)) ? $user->id : ""}}';

</script>
<link rel="stylesheet" href="{{asset('css/normalize.css')}}">
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/all.css')}}">
<link rel="stylesheet" href="{{asset('font/stylesheet.css')}}">
<link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
<!-- menu home -->
<link rel="stylesheet" href="{{asset('menu/nav.css')}}">
<link rel="stylesheet" href="{{asset('css/aos.css')}}">
<!-- validation engine -->
<link rel="stylesheet" href="{{asset('css/validationEngine.jquery.css')}}">
<!-- owl -->
<link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
<!-- select to -->
<link rel="stylesheet" href="{{asset('css/tagify.css')}}">
<link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="{{asset('css/media.css')}}">

