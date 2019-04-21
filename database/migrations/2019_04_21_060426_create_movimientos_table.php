<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', ['alta', 'baja'])->nullable();
            $table->string('remito');
            $table->unsignedInteger('id_usuario');
            $table->unsignedInteger('id_paciente')->nullable();
            $table->unsignedInteger('id_profesional')->nullable();
            $table->unsignedInteger('id_institucion')->nullable();

            $table->timestamps();


            //relationships
            $table->foreign('id_usuario')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_paciente')->references('id')->on('pacientes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_profesional')->references('id')->on('profesionales')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_institucion')->references('id')->on('instituciones')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
