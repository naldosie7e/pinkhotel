<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionReservacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion_reservacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_reservacion");
            $table->integer("calificacion_hotel");
            $table->integer("calificacion_habitacion");
            $table->integer("calificacion_atencion");
            $table->string("observacion");
            $table->timestamps();
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
        Schema::dropIfExists('calificacion_reservacion');
    }
}
