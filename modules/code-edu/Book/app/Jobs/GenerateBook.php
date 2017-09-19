<?php namespace CodeEdu\Book\Jobs;

use CodeEdu\Book\Notifications\BookExportedNotification;
use CodeEdu\Book\Services\BookExport;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class GenerateBook implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, Queueable;
    /**
     * @var Book
     */
    private $book;

    /**
     * Create a new job instance.
     *
     * @param Book $book
     */
    public function __construct($book)
    {
        //
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @param BookExport $bookExport
     * @throws \Exception
     */
    public function handle(BookExport $bookExport)
    {
        try {
            $bookExport->export($this->book);

            $easyBookCmd = "vendor/bin/easybook/book publish --no-interaction --dir={$this->book->disk} {$this->book->id}";

            exec("php " . base_path("$easyBookCmd print"));
            exec("php " . base_path("$easyBookCmd kindle"));
            exec("php " . base_path("$easyBookCmd ebook"));

            $bookExport->compress($this->book);

            $this->book->author->notify(
                new BookExportedNotification($this->book->author, $this->book)
            );
        } catch (\Exception $e) {
            $this->fail($e);
            throw $e;
        }
    }
}
