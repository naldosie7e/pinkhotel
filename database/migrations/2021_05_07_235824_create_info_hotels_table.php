<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInfoHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('codigo')->nullable();
            $table->string('nit')->nullable();
            $table->string('nombre')->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->string('representante_legal')->nullable();
            $table->string('telefono')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('info_hotels');
    }
}
