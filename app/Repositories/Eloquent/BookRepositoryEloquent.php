<?php

namespace CodePub\Repositories\Eloquent;

use CodePub\Repositories\Traits\CriteriaTrashedTrait;
use CodePub\Repositories\Traits\RepositoryRestoreTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Repositories\Contracts\BookRepository;
use CodePub\Models\Book;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    use CriteriaTrashedTrait,
        RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'title' => 'like',
        'author.name' => 'like',
        'categories.name' => 'like',
    ];

    /**
     * Save a new entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = parent::create($attributes);
        $model->categories()->sync($attributes['categories']);
        return $model;
    }

    /**
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        $model->categories()->sync($attributes['categories']);
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
