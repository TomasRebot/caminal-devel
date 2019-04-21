<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_medicamento');
            $table->string('lote');
            $table->date('fecha_vencimiento');
            $table->unsignedInteger('stock_caminal');
            $table->unsignedInteger('stock_remediar');
            $table->timestamps();

            //relationships

            $table->foreign('id_medicamento')->references('id')->on('medicamentos')
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
        Schema::dropIfExists('stocks');
    }
}
