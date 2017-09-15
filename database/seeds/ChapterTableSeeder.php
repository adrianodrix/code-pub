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
            $chapters = factory(\CodeEdu\Book\Models\Chapter::class, 5)->make();

            foreach ($chapters as $key => $chapter) {
                $chapter->book_id = $book->id;
                $chapter->order = $key + 1;
                $chapter->save();
            }
        }
    }
}
