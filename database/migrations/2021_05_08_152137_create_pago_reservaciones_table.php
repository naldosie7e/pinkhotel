<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagoReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_reservaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('id_reservacion');
            $table->boolean('pago_parcial')->default(false);
            $table->integer('valor_pago');
            $table->date('fecha_pago');
            $table->string('medio_pago');
            $table->foreign('id_reservacion')->references('id')->on('reservaciones');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pago_reservaciones');
    }
}
