<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;


class Establecimiento extends Model
{

  protected $table = "establecimientos";
  use Searchable;

  public function usuario(){
    return $this->belongsTo('App\Models\User' ,'id_usuario');
  }

  public function logo(){
    return $this->hasOne('App\Models\Logo' ,'id_establecimiento');
  }

  public function fachada(){
    return $this->hasOne('App\Models\Fachada' ,'id_establecimiento');
  }

  public function galeria(){
    return $this->hasMany('App\Models\Galeria' ,'id_establecimiento');

  }

  public function likes(){
    return $this->hasMany('App\Models\Like' ,'id_establecimiento');

  }

}
