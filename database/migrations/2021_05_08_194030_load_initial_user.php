<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LoadInitialUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            [
                'name'              => 'Admin',
                'email'                => 'admin@pinkhotel.com',
                'email_verified_at'              =>Carbon::now(),
                'password'     =>Hash::make('123456'),
                'remember_token'        => Hash::make('123456'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
                'rol_id'        => 2,
            ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
