<?php

namespace CodePub\Repositories\Criterias\Books;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByAuthorAuthenticatedCriteria
 * @package namespace CodePub\Repositories\Criterias\Books;
 */
class FindByAuthorAuthenticatedCriteria implements CriteriaInterface
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
        return $model->where('author_id', \Auth::user()->id);
    }
}
