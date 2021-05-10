<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('id_sucursal');
            $table->string('clasificacion');
            $table->integer('valor_dia')->nullable();
            $table->foreign('id_sucursal')->references('id')->on('sucursales')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('habitaciones');
    }
}