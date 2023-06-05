<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  protected $table = 'productos';
  protected $fillable = ['nombre', 'descripcion', 'establecimiento_id'];
  public $timestamps = false;

  public function fotos()
  {
    return $this->hasMany('App\Models\GaleriaProducto', 'producto_id');
  }
}
