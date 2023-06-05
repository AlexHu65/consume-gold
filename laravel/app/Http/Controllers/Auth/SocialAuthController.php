<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Models\Establecimiento;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
  //Metodo encargado de la redireccion a facebook
  public function redirectToProvider($provider){
    return Socialite::driver($provider)->redirect();
  }

  // Metodo encargado de obtener la información del usuario
  public function handleProviderCallback($provider)
  {
    // Obtenemos los datos del usuario
    $social_user = Socialite::driver($provider)->user();
    // Comprobamos si el usuario ya existe

    if ($user = User::where('email', $social_user->email)->first()) {
      // verificamos si tiene un negocio registrado
      $negocio =  Establecimiento::where(['activo' => '1' , 'id_usuario' => $user->id])->first();
      if(!$negocio){
        Auth::login($user);
        return redirect()->to('/registro');
      }
      return $this->authAndRedirect($user); // Login y redirección
    } else {
      // En caso de que no exista creamos un nuevo usuario con sus datos.
      $user = User::create([
        'name' => $social_user->name,
        'email' => $social_user->email,
        'avatar' => $social_user->avatar,
        'valido' => 1,
        'facebook' => '1',
        'email_verified_at' => now()
      ]);

      return $this->authAndRedirect($user); // Login y redirección
    }
  }

  // Login y redirección
  public function authAndRedirect($user)
  {
    Auth::login($user);

    return redirect()->to('/dashboard');
  }

}
