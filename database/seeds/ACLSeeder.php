<?php

use Illuminate\Database\Seeder;

class ACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAuthor = \CodeEdu\User\Models\Role::where('name', config('codeedubook.acl.role_author'))->first();
        $permissionsBook = \CodeEdu\User\Models\Permission::where('name', 'like', 'books%')->pluck('id')->all();
        $permissionsCategory = \CodeEdu\User\Models\Permission::where('name', 'like', 'categories%')->pluck('id')->all();

        $roleAuthor->permissions()->attach($permissionsBook);
        $roleAuthor->permissions()->attach($permissionsCategory);
    }
}
