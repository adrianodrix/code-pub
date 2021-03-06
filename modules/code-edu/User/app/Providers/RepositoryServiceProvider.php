<?php

namespace CodeEdu\User\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeEdu\User\Repositories\Contracts\UserRepository::class, \CodeEdu\User\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\CodeEdu\User\Repositories\Contracts\PermissionRepository::class, \CodeEdu\User\Repositories\Eloquent\PermissionRepositoryEloquent::class);
        $this->app->bind(\CodeEdu\User\Repositories\Contracts\RoleRepository::class, \CodeEdu\User\Repositories\Eloquent\RoleRepositoryEloquent::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
