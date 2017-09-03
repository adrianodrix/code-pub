<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \CodeEdu\User\Models\User::create([
            'name' =>  config('codeeduuser.user_default.name'),
            'email' => config('codeeduuser.user_default.email'),
            'password' => bcrypt(config('codeeduuser.user_default.password')),
            'verified' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \CodeEdu\User\Models\User::where('email', config('codeeduuser.user_default.email'))
            ->first()
            ->forceDelete();
    }
}
