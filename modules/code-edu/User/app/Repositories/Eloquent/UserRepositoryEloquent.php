<?php

namespace CodeEdu\User\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEdu\User\Repositories\Contracts\UserRepository;
use CodeEdu\User\Models\User;
use CodePub\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
