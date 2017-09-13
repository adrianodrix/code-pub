<?php

class ChapterTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        foreach (\CodeEdu\Book\Models\Book::all() as $book)
        {
            $order = 0;
            factory(\CodeEdu\Book\Models\Chapter::class, 10)->make()->each(function($chapter) use ($book, $order){
                $chapter->book_id = $book->id;
                $chapter->order = ++$order;
                $chapter->save();
            });
        }
    }
}
