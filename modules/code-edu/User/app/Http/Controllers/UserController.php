<?php

namespace CodeEdu\User\Http\Controllers;

use CodeEdu\User\Http\Requests\UserDeleteRequest;
use CodeEdu\User\Http\Requests\UserRequest;
use CodeEdu\User\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    /**
     * @var \CodeEdu\User\Repositories\Contracts\UserRepository
     */
    private $repository;

    /**
     * UsersController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="list", description="List of Users")
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
     * @Permission\Action(name="store", description="Create User")
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', ['type' => 'info', 'message' => 'Novo usuário foi registrado com sucesso!']);
        return redirect()->to($url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="store", description="Create User")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$roles = $this->roleRepository->all()->pluck('name', 'id');
        return view('codeeduuser::users.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Update User")
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function edit($id)
    {
        //$roles = $this->roleRepository->all()->pluck('name', 'id');
        $user = $this->repository->find($id);
        return view('codeeduuser::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Update User")
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

        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', ['type' => 'info', 'message' => 'Usuário foi alterado com sucesso!']);
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="destroy", description="Destroy User")
     * @param UserDeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     * @internal param int $id
     */
    public function destroy(UserDeleteRequest $request,$id)
    {
        $this->repository->delete($id);
        \Session::flash('message', ['type' => 'info', 'message' => 'Usuário excluído com sucesso!']);
        return redirect()->to(\URL::previous());
    }
}
