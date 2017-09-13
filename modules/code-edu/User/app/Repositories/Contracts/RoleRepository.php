<?php

namespace CodeEdu\User\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository
 * @package namespace CodePub\Repositories\Contracts;
 */
interface RoleRepository extends RepositoryInterface
{
    /**
     * Update Permissions
     *
     * @param array $permissions
     * @param $id
     * @return $this
     */
    public function updatePermissions(array $permissions, $id);
}
