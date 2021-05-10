<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->string('numero_documento')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('genero');
            $table->integer('edad')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->string('telefono')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clientes');
    }
}