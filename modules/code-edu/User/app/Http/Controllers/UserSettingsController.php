<?php

namespace CodeEdu\User\Http\Controllers;

use CodeEdu\User\Http\Requests\UserSettingsRequest;
use CodeEdu\User\Repositories\Contracts\UserRepository;
use Illuminate\Routing\Controller;

class UserSettingsController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Show the form for editing the specified resource.
     * @internal param User $user
     */
    public function edit()
    {
        $user = \Auth::user();
        return view('codeeduuser::users.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserSettingsRequest $request)
    {
        $user = \Auth::user();

        $this->repository->update($request->all(), $user->id);

        $request->session()->flash('message', ['type' => 'info', 'message' => 'Usuário alterado com sucesso!']);
        return redirect()->route('codeeduuser.user.profile.edit');
    }
}
