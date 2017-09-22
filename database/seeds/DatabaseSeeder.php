<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        \Schema::disableForeignKeyConstraints();

        \Artisan::call('codeeduuser:make-permission');

        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(ChapterTableSeeder::class);
        $this->call(ACLSeeder::class);

        \Schema::enableForeignKeyConstraints();
        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
