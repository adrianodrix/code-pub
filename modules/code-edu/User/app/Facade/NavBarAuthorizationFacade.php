<?php namespace CodeEdu\User\Facade;

use CodeEdu\User\Menu\Navbar;
use Illuminate\Support\Facades\Facade;

class NavBarAuthorizationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return Navbar::class;
    }
}