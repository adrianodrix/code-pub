<?php namespace CodeEdu\Book\Models\Traits;

/**
 * Class BookStorageTrait
 * @package CodeEdu\Book\Models\Traits
 */
trait BookStorageTrait
{
    /**
     * Get disk path for books
     *
     * @return string
     */
    public function getDiskAttribute()
    {
        $bookStorageDriver = config('codeedubook.book_storage');
        return config("filesystems.disks.{$bookStorageDriver}.root");
    }

    /**
     * Get Cover Book Name
     * @return string
     */
    public function getCoverEbookNameAttribute()
    {
        return 'cover.jpg';
    }

    /**
     * Get E-book templates
     * @return string
     */
    public function getEbookTemplateAttribute()
    {
        return "{$this->id}/Resources/Templates/Ebook";
    }

    /**
     * Get Cover E-book File
     * @return string
     */
    public function getCoverEbookFileAttribute()
    {
        return "{$this->disk}/{$this->ebook_template}/{$this->cover_ebook_name}";
    }

    /**
     * Cover PDF file name
     * @return string
     */
    public function getCoverPdfNameAttribute()
    {
        return 'cover.pdf';
    }

    /**
     * Get PDF file template
     * @return string
     */
    public function getPdfTemplateAttribute()
    {
        return "{$this->id}/Resources/Templates/pdf";
    }

    /**
     * Get pdf template path storage
     * @return string
     */
    public function getPdfTemplateStorageAttribute()
    {
        return "{$this->disk}/{$this->pdf_template}";
    }

    /**
     * Get cover pdf file name
     * @return string
     */
    public function getCoverPdfFileAttribute()
    {
        return "{$this->pdf_template_storage}/{$this->cover_pdf_name}";
    }

    /**
     * Get Book Storage
     * @return string
     */
    public function getBookStorageAttribute()
    {
        return "{$this->disk}/{$this->id}";
    }

    /**
     * Get contents book
     * @return string
     */
    public function getContentsStorageAttribute()
    {
        return "{$this->book_storage}/Contents";
    }

    /**
     * Get config file
     * @return string
     */
    public function getConfigFileAttribute()
    {
        return "{$this->book_storage}/config.yml";
    }

    /**
     * Get template config file
     * @return string
     */
    public function getTemplateConfigFileAttribute()
    {
        return "{$this->disk}/template/config.yml";
    }

    /**
     * output storage
     * @return string
     */
    public function getOutputStorageAttribute()
    {
        return "{$this->book_storage}/Output";
    }

    /**
     * Get zip file name
     * @return string
     */
    public function getZipFileAttribute()
    {
        $titleSlug = str_slug($this->title, '-');
        return "{$this->book_storage}/book-$titleSlug.zip";
    }
}