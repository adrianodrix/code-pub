<?php namespace CodeEdu\Book\Services;

use CodeEdu\Book\Models\Book;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;

/**
 * Class CoverUpload
 * @package CodeEdu\Book\Services
 */
class CoverUpload
{
    /**
     * Upload image cover
     *
     * @param Book $book
     * @param UploadedFile $file
     */
    public function upload(Book $book, UploadedFile $file)
    {
        \Storage::disk(config('codeedubook.book_storage'))
            ->putFileAs($book->ebook_template, $file, $book->cover_ebook_name);

        $this->makeCoverPdf($book);
        $this->makeThumbnail($book);
    }

    /**
     * Make cover PDF file
     * @param Book $book
     */
    protected function makeCoverPdf(Book $book) {
        if(!is_dir($book->pdf_template_storage)) {
            mkdir($book->pdf_template_storage, 0775, true);
        }

        $img = new \Imagick($book->cover_ebook_file);
        $img->setImageFormat('pdf');

        $img->writeImage($book->cover_pdf_file);
    }

    protected function makeThumbnail(Book $book)
    {
        if(!is_dir($book->thumbs_storage)) {
            mkdir($book->thumbs_storage, 0775, true);
        }

        // Thumbnail normal
        \FImage::open($book->cover_ebook_file)
            ->thumbnail(new Box(356, 522))
            ->save($book->thumbnail_file);

        // Thumbnail small
        \FImage::open($book->cover_ebook_file)
            ->thumbnail(new Box(138, 230))
            ->save($book->thumbnail_small_file);
    }
}