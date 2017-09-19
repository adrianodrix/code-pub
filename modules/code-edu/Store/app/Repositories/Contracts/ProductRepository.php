<?php namespace CodeEdu\Store\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 *
 * @package namespace CodeEdu\Store\Repositories\Contracts;
 */
interface ProductRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function home();
    public function findByCategory($id);
    public function findBySlug($slug);
    public function makeProductStore($id);
    public function like($search);
}