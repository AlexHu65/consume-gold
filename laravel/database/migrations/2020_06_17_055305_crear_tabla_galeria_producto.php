<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaGaleriaProducto extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('galeria_producto', function (Blueprint $table) {
      $table->increments('id');
      $table->string('img', 255);
      $table->integer('producto_id')->unsigned();
      $table->foreign('producto_id')->references('id')->on('productos');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('galeria_producto');
  }
}
