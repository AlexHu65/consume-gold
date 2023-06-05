<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriaProducto extends Model
{
  protected $table = 'galeria_producto';
  protected $fillable = ['img', 'producto_id'];
  public $timestamps = false;
}
