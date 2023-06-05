@extends('master')
@section('title', 'Reestablecer contraseña')
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
        <img style="width:100%;" src="{{asset('images/login.jpg')}}" alt="Guanajuato">
      </div>
      <div class="col-md-6">
        <div class="card  z-depth-1">
          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
              @csrf

              <div class="form-group row">

                <div class="col-md-12">
                  <h2 class="text-center font-weight-bold s25 advent active-red pb-4">REESTABLECER CONTRASEÑA</h2>

                  <input placeholder="Correo electrónico" id="email" type="email" class="browser-default form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-12 offset-md-3">
                  <button type="submit" class="btn-hover color-11 s13">
                    {{ __('Reestablecer contraseña.') }}
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
