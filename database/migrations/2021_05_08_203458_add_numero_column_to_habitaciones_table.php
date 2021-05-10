<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroColumnToHabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->integer('numero_habitacion')->nullable();
        });
        Schema::table('sucursales', function (Blueprint $table) {
            $table->string('nombre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habitaciones', function (Blueprint $table) {
            //
        });
    }
}