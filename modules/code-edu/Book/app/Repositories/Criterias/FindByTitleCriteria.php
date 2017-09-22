<?php

namespace CodeEdu\Book\Repositories\Criterias;

use CodePub\Repositories\Criterias\strings;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByTitleCriteria
 * @package namespace CodePub\Repositories\Criterias\Books;
 */
class FindByTitleCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * FindByTitleCriteriaCriteria constructor.
     *
     * @param strings $title
     */
    public function __construct($title)
    {
        $this->title = $title;
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
        return $model->where('title', $this->title);
    }
}
