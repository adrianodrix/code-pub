<?php

namespace CodeEdu\User\Http\Controllers;

use CodeEdu\User\Http\Requests\UserDeleteRequest;
use CodeEdu\User\Http\Requests\UserRequest;
use CodeEdu\User\Repositories\Contracts\RoleRepository;
use CodeEdu\User\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CodeEdu\User\Annotations\Mapping as Permission;

/**
 * Class UserController
 *
 * @Permission\Controller(name="users", description="Usuários")
 * @package CodeEdu\User\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var \CodeEdu\User\Repositories\Contracts\UserRepository
     */
    private $repository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $repository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
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
        $users = $this->repository->orderBy('name')->paginate(5);
        return view('codeeduuser::users.index', compact('users', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="store", description="Novo")
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()
            ->to($request->get('redirect_to', route('codeeduuser.users.index')))
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
        $roles = $this->roleRepository->all()->pluck('description', 'id');
        return view('codeeduuser::users.create', compact('roles'));
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
        $roles = $this->roleRepository->all()->pluck('description', 'id');
        $user = $this->repository->find($id);
        return view('codeeduuser::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param \CodeEdu\User\Http\Requests\UserRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except('password');
        $this->repository->update($data, $id);

        return redirect()
            ->to($request->get('redirect_to', route('codeeduuser.users.index')))
            ->with('message', ['type' => 'info', 'message' => 'Usuário foi alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="destroy", description="Excluir")
     * @param UserDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function destroy(UserDeleteRequest $request,$id)
    {
        $this->repository->delete($id);

        return redirect()
            ->to(\URL::previous())
            ->with('message', ['type' => 'info', 'message' => 'Usuário excluído com sucesso!']);
    }
}
