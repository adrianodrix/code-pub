<?php
namespace CodePub\Repositories\Criterias\Contracts;

interface CriteriaTrashedInterface
{
    /**
     * Get Only Trashed registers
     *
     * @return $this
     */
    public function onlyTrashed();

    /**
     * Get all with Trashed registers
     *
     * @return $this
     */
    public function withTrashed();
}