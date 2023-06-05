@extends('master')
@section('title', 'Iniciar Sesión')
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
    <div class="row justify-content-center">
      <div class="col-md-6">
        <img src="{{asset('images/login.jpg')}}" alt="Guanajuato">
      </div>
      <div class="col-md-6">
        <div class="card  z-depth-1">
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group row">

                <div class="col-md-12">
                  <h2 class="text-center font-weight-bold s25 advent active-red">INICIAR SESIÓN</h2>
                  <div class="contenido mb-3">
                    <div class="contenido2">
                      <a href="{{ route('social.auth', 'facebook') }}" class="facebook-button text-light"> <i class="fab fa-facebook-square"></i> INICIAR SESIÓN CON FACEBOOK</a>
                    </div>
                  </div>
                  <div class="divider"></div>
                  <div class="input-field col s12">
                    <input id="email" type="email" class="@error('email') is-invalid @enderror browser-default form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <div class="input-field col s12">
                    <input id="password" type="password" class="@error('password') is-invalid @enderror browser-default form-control" name="password" required placeholder="Contraseña" autocomplete="current-password">

                    <small class="float-left font-weight-bold mt-2">
                      <a class="text-muted active-red" href="{{ route('password.request') }}">
                        {{ __('Olvidé mi contraseña') }}
                      </a>
                    </small>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                  <label>
                  <input class="giro-check"  type="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span>Recordarme</span>
                </label>
                <!-- <div class="form-check">
                  <input class="browser-default form-control" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                  </label>
                </div> -->
              </div>
            </div>

            <div class="form-group row">
              <div class="text-center col-md-12">
                <button type="submit" class="btn-hover color-11 s13">
                  {{ __('Iniciar sesión') }}
                </button>

              </div>
            </div>
            <div class="form-group row ">
              <div class="text-center col-md-12">

                <div class="pt-3">
                  @if (Route::has('password.request'))
                  <small class="text-center">
                    <a class="text-muted font-weight-bold cuenta-red" href="{{ route('register') }}">
                      {{ __('Aún no tengo mi cuenta') }}
                    </a>
                  </small>
                  @endif
                </div>
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
