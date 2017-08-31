<?php

namespace CodeEdu\Book\Repositories\Contracts;

use CodePub\Repositories\Contracts\RepositoryRestoreInterface;
use CodePub\Repositories\Criterias\Contracts\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BookRepository
 * @package namespace CodePub\Repositories\Contracts;
 */
interface BookRepository extends
    RepositoryInterface,
    RepositoryCriteriaInterface,
    CriteriaTrashedInterface,
    \CodePub\Repositories\Contracts\RepositoryRestoreInterface
{
    //
}
