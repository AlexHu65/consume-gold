@extends('master')
@section('title', 'Reestablecer la contraseña')
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
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">

                        <div class="col-md-12">
                            <h2 class="text-center font-weight-bold s25 advent active-red">REESTABLECER CONTRASEÑA</h2>
                            <input id="email" type="email" placeholder="Email" class="browser-default form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password" type="password" placeholder="Contraseña" class="browser-default form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" placeholder="Confirmar contraseña" class="browser-default form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn-hover color-11 s13">
                                {{ __('Reestablecer') }}
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
