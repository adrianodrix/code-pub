<?php

use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = \CodeEdu\User\Models\Role::create([
            'name' => config('codeeduuser.acl.role_admin'),
            'description' => 'Administrador do Sistema'
        ]);
        $user = \CodeEdu\User\Models\User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = \CodeEdu\User\Models\Role::where('name', config('codeeduuser.acl.role_admin'))->first();
        $user = \CodeEdu\User\Models\User::where('email', config('codeeduuser.user_default.email'))->first();

        $user->roles()->detach($roleAdmin->id);
        $roleAdmin->delete();
    }
}
