<?php namespace CodeEdu\User\Repositories\Eloquent;

use CodeEdu\User\Models\Permission;
use CodeEdu\User\Repositories\Contracts\PermissionRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEdu\User\Models\User;


/**
 * Class PermissionRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{

    protected $fieldSearchable = [
        'name' => '=',
        'description' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
