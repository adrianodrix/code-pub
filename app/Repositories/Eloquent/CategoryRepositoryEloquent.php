<?php

namespace CodePub\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Repositories\Contracts\CategoryRepository;
use CodePub\Models\Category;
use CodePub\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
