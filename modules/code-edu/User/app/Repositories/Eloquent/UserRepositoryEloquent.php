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

    protected $fieldSearchable = [
        'name' => 'like',
        'email' => '='
    ];

    /**
     * Create an User
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $attributes['password'] = User::generatePassword();
        $user = parent::create($attributes);
        $user->roles()->sync($attributes['roles']);

        \UserVerification::generate($user);

        config([
            'user-verification.email.view' => 'codeeduuser::emails.user-created'
        ]);

        \UserVerification::sendQueue($user, config('codeeduuser.emails.user_created.subject'));

        return $user;
    }

    /**
     * Update an User
     *
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        if (array_key_exists('password', $attributes)) {
            $attributes['password'] = User::generatePassword($attributes['password']);
        }
        $user = parent::update($attributes, $id);
        $user->roles()->sync($attributes['roles']);

        return $user;
    }

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
