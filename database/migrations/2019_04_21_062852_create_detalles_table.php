<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('destino', ['caminal', 'remediar'])->nullable();
            $table->unsignedInteger('id_stock');
            $table->unsignedInteger('id_movimiento');
            $table->unsignedInteger('cantidad')->nullable();

            $table->timestamps();

            $table->foreign('id_movimiento')->references('id')->on('movimientos')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_stock')->references('id')->on('stocks')
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
        Schema::dropIfExists('detalles');
    }
}
