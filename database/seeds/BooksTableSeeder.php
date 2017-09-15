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
        $collection = app(\CodeEdu\Book\Repositories\Contracts\CategoryRepository::class)->all();

        factory(\CodeEdu\Book\Models\Book::class, 30)
            ->create()
            ->each(function($book) use ($collection) {
                $book->categories()->sync($collection->random(4)->pluck('id'));
            });
    }
}
