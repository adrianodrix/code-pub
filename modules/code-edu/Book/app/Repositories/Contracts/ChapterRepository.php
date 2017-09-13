<?php

namespace CodeEdu\Book\Repositories\Contracts;

use CodePub\Repositories\Contracts\RepositoryRestoreInterface;
use CodePub\Repositories\Criterias\Contracts\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ChapterRepository
 * @package namespace CodePub\Repositories\Contracts;
 */
interface ChapterRepository extends
    RepositoryInterface,
    RepositoryCriteriaInterface
{
    //
}
