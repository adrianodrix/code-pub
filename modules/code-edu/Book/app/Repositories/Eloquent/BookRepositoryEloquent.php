<?php

namespace CodeEdu\Book\Repositories\Eloquent;

use CodeEdu\Book\Repositories\Criterias\FindByAuthorCriteria;
use CodePub\Repositories\Eloquent\ValidatorException;
use CodePub\Repositories\Traits\CriteriaTrashedTrait;
use CodePub\Repositories\Traits\RepositoryRestoreTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEdu\Book\Repositories\Contracts\BookRepository;
use CodeEdu\Book\Models\Book;

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
        $attributes['published'] = isset($attributes['published']);

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
        $this->pushCriteria(app(FindByAuthorCriteria::class));
    }
}
