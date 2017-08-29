<?php

namespace CodePub\Repositories\Eloquent;

use CodePub\Repositories\Traits\BaseRepositoryTrait;
use CodePub\Repositories\Traits\CriteriaTrashedTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Repositories\Contracts\CategoryRepository;
use CodePub\Models\Category;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use BaseRepositoryTrait,
        CriteriaTrashedTrait;

    protected $fieldSearchable = [
        'name' => 'like'
    ];

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

    /**
     * Get Lists with Mutators
     *
     * @param $column
     * @param null $key
     * @return \Illuminate\Support\Collection
     */
    public function listsWithMutators($column, $key = null)
    {
        /** @var Collection $collection */
        $collection = $this->all();
        return $collection->pluck($column, $key);
    }
}
