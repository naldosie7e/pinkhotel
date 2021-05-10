<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('id_hotel');
            $table->unsignedBigInteger('id_sucursal');
            $table->unsignedBigInteger('id_habitacion');
            $table->string('dias_reservacion')->nullable();
            $table->string('valor_reservacion')->nullable();
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->integer('estado')->nullable();
            $table->foreign('id_hotel')->references('id')->on('info_hotels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_sucursal')->references('id')->on('sucursales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_habitacion')->references('id')->on('habitaciones')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservaciones');
    }
}
