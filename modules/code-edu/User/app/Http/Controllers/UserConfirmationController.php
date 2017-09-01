<?php

namespace CodeEdu\User\Http\Controllers;

use CodeEdu\User\Repositories\Contracts\UserRepository;
use Illuminate\Routing\Controller;
use Jrean\UserVerification\Traits\VerifiesUsers;

class UserConfirmationController extends Controller
{
    use VerifiesUsers;

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Redirect afetar verification
     *
     * @return string
     */
    public function redirectAfterVerification()
    {
        $this->loginUser();
        return route('codeeduuser.user.profile.edit');

    }

    /**
     * Login User
     * @return void
     */
    private function loginUser(){
        $email = \Request::get('email');
        $user = $this->repository->findByField('email', $email)->first();
        return \Auth::login($user);
    }
}
