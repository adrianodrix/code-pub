<?php

namespace CodePub\Repositories\Traits;

use CodePub\Repositories\Criterias\FindOnlyTrashedCriteria;
use CodePub\Repositories\Criterias\FindWithTrashedCriteria;

trait CriteriaTrashedTrait
{
    /**
     * Get Only Trashed registers
     *
     * @return $this
     */
    public function onlyTrashed()
    {
        $this->pushCriteria(FindOnlyTrashedCriteria::class);
        return $this;
    }

    /**
     * Get all with Trashed registers
     *
     * @return $this
     */
    public function withTrashed()
    {
        $this->pushCriteria(FindWithTrashedCriteria::class);
        return $this;
    }
}