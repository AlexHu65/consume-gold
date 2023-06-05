<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nombre', 70);
        $table->string('descripcion', 255)->nullable();
        $table->mediumInteger('voto_positivo')->default(0);
        $table->mediumInteger('voto_negativo')->default(0);
        $table->integer('establecimiento_id')->unsigned();
        $table->foreign('establecimiento_id')->references('id')->on('establecimientos');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productos');
    }
}
