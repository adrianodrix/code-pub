<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeEdu\User\Models\User::class, 1)->create([
            'name' => 'Adriano Santos',
            'email' => 'admin@codepub.com',
        ]);

        factory(\CodeEdu\User\Models\User::class, 10)->create();

        $roleAuthor = \CodeEdu\User\Models\Role::where('name', config('codeedubook.acl.role_author'))->first();
        $authors = factory(\CodeEdu\User\Models\User::class, 10)->create();
        foreach ($authors as $author) {
            $author->roles()->attach($roleAuthor->id);
        }
    }
}
