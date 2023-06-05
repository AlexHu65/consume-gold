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
    <div class="row justify-content-center">
      <div class="col-md-6">
        <img style="width:100%;" src="{{asset('images/login.jpg')}}" alt="Guanajuato">
      </div>
      <div class="col-md-6">

        <div class="card">

          <div class="card-body">
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
              {{ __('Una nueva dirección de autenticación ha sido enviada a tu email.') }}
            </div>
            @endif

            {{ __('Antes de continuar, verifica tu cuenta con el email que te hemos enviado.') }} <br>
            {{ __('Si no recibiste el email.') }} <br>
            <strong>VERIFICA TU BANDEJA DE "NO DESEADOS" O "SPAM"</strong>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
              @csrf
              <button type="submit" class="btn-hover color-11 s13">{{ __('Click para recibir otro.') }}</button>
            </form>
          </div>
        </div>



      </div>
    </div>
  </div>
</section>
@endsection
