<?php namespace CodeEdu\Book\Models\Traits;

/**
 * Class BookThumbnailTrait
 * @package CodeEdu\Book\Models\Traits
 */
trait BookThumbnailTrait
{
    /**
     * Get thumbnail file name
     * @return string
     */
    public function getThumbnailNameAttribute()
    {
        return "{$this->id}.jpg";
    }

    /**
     * Get thumbnail small file name
     * @return string
     */
    public function getThumbnailSmallNameAttribute()
    {
        return "{$this->id}_small.jpg";
    }

    /**
     * Get thumbs path
     * @return mixed
     */
    public function getThumbsPathAttribute()
    {
        return config('codeedubook.book_thumbs');
    }

    /**
     * Get thumbs storage path
     * @return string
     */
    public function getThumbsStorageAttribute()
    {
        return public_path($this->thumbs_path);
    }

    /**
     * Get thumbnail relative path
     * @return string
     */
    public function getThumbnailRelativeAttribute()
    {
        if (file_exists($this->thumbnail_file)) {
            return "{$this->thumbs_path}/{$this->thumbnail_name}";
        }
        return "http://d1pkzhm5uq4mnt.cloudfront.net/imagens/capas/_8541bde9250b8d47084a7d2153276cb6d3b165e5.jpg";
    }

    /**
     * Get thumbnail small relative path
     * @return string
     */
    public function getThumbnailSmallRelativeFileAttribute()
    {
        if (file_exists($this->thumbnail_small_file)) {
            return "{$this->thumbs_path}/{$this->thumbnail_small_name}";
        }
        return "http://d1pkzhm5uq4mnt.cloudfront.net/imagens/capas/_8541bde9250b8d47084a7d2153276cb6d3b165e5.jpg";
    }

    /**
     * Get thumbnail file
     *
     * @return string
     */
    public function getThumbnailFileAttribute()
    {
        return "{$this->thumbs_storage}/{$this->thumbnail_name}";
    }

    /**
     * Get thumbnail small file
     * @return string
     */
    public function getThumbnailSmallFileAttribute()
    {
        return "{$this->thumbs_storage}/{$this->thumbnail_small_name}";
    }
}