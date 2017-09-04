<?php

namespace CodeEdu\User\Http\Controllers;

use CodeEdu\User\Http\Requests\PermissionRequest;
use CodeEdu\User\Http\Requests\RoleDeleteRequest;
use CodeEdu\User\Http\Requests\RoleRequest;
use CodeEdu\User\Repositories\Contracts\PermissionRepository;
use CodeEdu\User\Repositories\Contracts\RoleRepository;
use CodeEdu\User\Repositories\Criteria\FindPermissionsGroupCriteria;
use CodeEdu\User\Repositories\Criteria\FindPermissionsResourceCriteria;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use CodeEdu\User\Annotations\Mapping as Permission;

/**
 * Class RoleController
 *
 * @Permission\Controller(name="roles", description="Grupo de Usuários")
 * @package CodeEdu\User\Http\Controllers
 */
class RoleController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="index", description="Consultar")
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $roles = $this->repository->orderBy('description')->paginate(5);
        return view('codeeduuser::roles.index', compact('roles', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="store", description="Novo")
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()
            ->to($request->get('redirect_to', route('codeeduuser.roles.index')))
            ->with('message', ['type' => 'info', 'message' => 'Novo usuário foi registrado com sucesso!']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="store", description="Novo")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function edit($id)
    {
        //$roles = $this->roleRepository->all()->pluck('name', 'id');
        $user = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param \CodeEdu\User\Http\Requests\RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->except('permissions');
        $this->repository->update($data, $id);

        return redirect()
            ->to($request->get('redirect_to', route('codeeduuser.roles.index')))
            ->with('message', ['type' => 'info', 'message' => 'Perfil de Usuário foi alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="destroy", description="Excluir")
     * @param RoleDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleDeleteRequest $request,$id)
    {
        try {
            $this->repository->delete($id);
            $message = ['type' => 'info', 'message' => 'Perfil de Usuário excluído com sucesso!'];
        } catch (QueryException $e) {
            $message = ['type' => 'danger', 'message' => 'Perfil de usuário não pode ser excluído. Ele está vinculado com outros registros.'];
        }

        return redirect()
            ->to(\URL::previous())
            ->with('message', $message);
    }

    /**
     *
     * @Permission\Action(name="list-permission", description="Listar Permissões")
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPermission($id){
        $role = $this->repository->find($id);
        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();

        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupCriteria());
        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);

        return view('codeeduuser::roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }

    /**
     * @Permission\Action(name="update-permission", description="Editar Permissões")
     * @param PermissionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermission(PermissionRequest $request, $id){
        $data = $request->get('permissions', []);
        $this->repository->updatePermissions($data, $id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));

        $request->session()->flash('message', ['type' => 'info', 'message' => 'Permissões do Perfil foi alterado com sucesso!']);
        return redirect()->to($url);
    }
}
