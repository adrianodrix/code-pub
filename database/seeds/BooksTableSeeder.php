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
        $bookUpload = app(\CodeEdu\Book\Services\CoverUpload::class);

        $books = factory(\CodeEdu\Book\Models\Book::class, 8000)
            ->create()
            ->each(function($book) use ($collection, $bookUpload) {
                $book->categories()->sync($collection->random(4)->pluck('id')->all());

                $thumbFileName = "l" . rand(1,5) . ".png";
                $thumbFile = new \Illuminate\Http\UploadedFile(
                    storage_path("app/files/faker/thumbs/$thumbFileName"),
                    $thumbFileName
                );
                $bookUpload->upload($book, $thumbFile);
            });

        \File::copyDirectory(storage_path('app/books/template'), storage_path('app/template'));
        \File::deleteDirectory(storage_path('app/books'));

        \File::copyDirectory(storage_path('app/template'), storage_path('app/books/template'));
        \File::deleteDirectory(storage_path('app/template'));

        $books->slice(0,5)->each(function($book) {
            \Notification::shouldReceive('send')->never();
            $job = (new \CodeEdu\Book\Jobs\GenerateBook($book))->onConnection('sync');
            dispatch($job);
        });
    }
}
