<?php
namespace CodePub\Repositories\Contracts;

interface RepositoryRestoreInterface
{
    /**
     * Restore register trashed
     *
     * @param $id
     */
    public function restore($id);
}