<?php namespace CodeEdu\Book\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByBookAuthenticatedCriteria
 * @package namespace CodePub\Repositories\Criterias\Books;
 */
class FindByBookCriteria implements CriteriaInterface
{
    /**
     * @var integer
     */
    private $bookId;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('book_id', $this->bookId);
    }
}
