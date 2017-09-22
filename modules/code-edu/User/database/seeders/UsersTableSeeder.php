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
        factory(\CodeEdu\User\Models\User::class, 50)->create();

        factory(\CodeEdu\User\Models\User::class, 1)->create([
            'name' => 'Adriano Santos',
            'email' => 'admin@codepub.com',
        ]);
    }
}
