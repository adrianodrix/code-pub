<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = app(\CodePub\Repositories\Contracts\CategoryRepository::class)->all();

        factory(CodePub\Models\Book::class,50)
            ->create()
            ->each(function($book) use ($collection) {
                $book->categories()->sync($collection->random(4)->pluck('id')->all());
            });
    }
}
