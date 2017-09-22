<?php namespace CodeEdu\Store\Repositories\Contracts;

use CodeEdu\Store\Models\ProductStore;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodeEduStore\Repositories;
 */
interface OrderRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function process($token, $user, ProductStore $productStore);
}