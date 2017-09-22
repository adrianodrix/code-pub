<?php

namespace CodeEdu\Book\Repositories\Contracts;

use CodePub\Repositories\Criterias\Contracts\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodePub\Repositories\Contracts;
 */
interface CategoryRepository extends
    RepositoryInterface,
    \CodePub\Repositories\Criterias\Contracts\CriteriaTrashedInterface
{
    /**
     * Get Lists with Mutators
     *
     * @param $column
     * @param null $key
     * @return \Illuminate\Support\Collection
     */
    public function listsWithMutators($column, $key = null);
}
