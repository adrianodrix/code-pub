<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAuthorData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \CodeEdu\User\Models\Role::create([
            'name' => config('codeedubook.acl.role_author'),
            'description' => 'Autor'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAuthor = \CodeEdu\User\Models\Role::where('name', config('codeedubook.acl.role_author'))->first();
        $roleAuthor->permissions()->detach();
        $roleAuthor->users()->detach();
        $roleAuthor->delete();
    }
}
