<?php

namespace CodePub\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Repositories\Contracts\BookRepository;
use CodePub\Models\Book;
use CodePub\Validators\BookValidator;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
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
