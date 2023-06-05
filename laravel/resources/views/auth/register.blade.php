@extends('master')
@section('title', 'Registrarme')
@section('content')

<section id="loginForm">
  <style>
  body{
    background: #e7e7c7;
  }
  #header{
    background: rgba(207, 0, 15, .8);
  }
  #loginForm{
    padding-top: 155px;
  }
  </style>
  <div class="container pt-5 pb-5">
    <div class="row mt-2">
      <div class="col">
        <div class="play-button">

        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="right-video w100">
          <div class="play-button">
            <a class="fancybox-media" href="{{asset('images/tutorial.mp4')}}">
              <img src="{{asset('images/icon-video.png')}}" alt="ver tutorial">      
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card  z-depth-1">
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group row">
                <div class="col-md-12">
                  <h2 class="text-center font-weight-bold s25 advent active-red">REGISTRARME</h2>                  
                  <div class="contenido mb-3">
                    <div class="contenido2">
                      <a href="{{ route('social.auth', 'facebook') }}" class="facebook-button text-light"> <i class="fab fa-facebook-square"></i> REGISTRARME CON FACEBOOK</a>
                    </div>
                  </div>
                  <div class="divider"></div>
                  <input id="name" type="text" class="browser-default form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nombre completo" autofocus>
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">


                <div class="col-md-12">
                  <input placeholder="Correo electrónico" id="email" type="email" class="browser-default form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">


                <div class="col-md-12">
                  <input placeholder="Contraseña" id="password" type="password" class="browser-default form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input placeholder="Confirmar contraseña" id="password-confirm" type="password" class="browser-default form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <button type="submit" class="btn-hover color-11 s13">
                    {{ __('Registrarme') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
