<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('id_hotel');
            $table->string('codigo')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->string('telefono')->nullable();
            $table->foreign('id_hotel')->references('id')->on('info_hotels')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sucursales');
    }
}