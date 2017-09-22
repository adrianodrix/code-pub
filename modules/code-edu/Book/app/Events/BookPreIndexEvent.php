<?php namespace CodeEdu\Book\Events;

use CodeEdu\Book\Models\Book;

class BookPreIndexEvent
{
    /**

     * @var Book
     */
    private $book;

    /**
     * @var int
     */
    private $ranking = 0;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }

    /**
     * @param Book $book
     */
    public function setBook(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return int
     */
    public function getRanking(): int
    {
        return $this->ranking;
    }

    /**
     * @param int $ranking
     */
    public function setRanking(int $ranking)
    {
        $this->ranking = $ranking;
    }


}
