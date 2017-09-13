<?php namespace CodeEdu\User\Repositories\Eloquent;

use CodeEdu\User\Models\Role;
use CodeEdu\User\Repositories\Contracts\RoleRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class PermissionRepositoryEloquent
 * @package namespace CodePub\Repositories\Eloquent;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
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
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Update Permissions
     *
     * @param array $permissions
     * @param $id
     * @return mixed
     */
    public function updatePermissions(array $permissions, $id)
    {
        $model = $this->find($id);
        $model->permissions()->detach();
        if(count($permissions)) {
            $model->permissions()->sync($permissions);
        }
        return $model;
    }
}
