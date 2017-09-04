<?php namespace CodeEdu\User\Facade;

use Illuminate\Support\Facades\Facade;
use CodeEdu\User\Annotations\PermissionReader as PermissionReaderService;

class PermissionReaderFacade extends Facade
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
        return PermissionReaderService::class;
    }
}