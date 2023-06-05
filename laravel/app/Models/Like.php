<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Like extends Model
{

  protected $table = 'likes';

  public function user()
    {
    return $this->belongsTo('App\Models\User');
    }

    public function negocio(){
    return $this->belongsTo('App\Models\Establecimiento');

    }

}
