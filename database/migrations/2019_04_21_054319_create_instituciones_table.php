<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('razon_social');
            $table->string('cuit');
            $table->string('direccion');
            $table->string('telefono_contacto');
            $table->enum('apto_clearing', ['si', 'no'])->default('no');
            $table->enum('estado', ['eliminado', 'activo'])->nullable()->default('activo');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituciones');
    }
}
