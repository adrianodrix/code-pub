<?php

namespace CodeEdu\User\Http\Requests;

use CodeEdu\User\Repositories\Contracts\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * RoleRequest constructor.
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $roleid = $this->route('role');
        $id = $roleid ? $roleid : "NULL";
        return [
            'name' => "required|max:255|unique:roles,name,$id",
            'description' => "required|max:255",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = $this->repository->findByField('name', config('codeeduuser.acl.role_admin'))->first();
        return $this->route('role') != $role->id;
    }
}
