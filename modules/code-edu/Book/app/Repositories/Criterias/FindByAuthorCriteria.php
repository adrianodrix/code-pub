<?php

namespace CodeEdu\Book\Repositories\Criterias;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByAuthorAuthenticatedCriteria
 * @package namespace CodePub\Repositories\Criterias\Books;
 */
class FindByAuthorCriteria implements CriteriaInterface
{
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
        if (!\Auth::user()->can('books/all')) {
            return $model->where('author_id', \Auth::user()->id);
        }
        return $model;
    }
}
