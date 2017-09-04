<?php

namespace CodeEdu\User\Providers;

use CodeEdu\User\Repositories\Contracts\PermissionRepository;
use CodeEdu\User\Repositories\Criteria\FindPermissionsResourceCriteria;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        \Gate::before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        \Gate::define('is-admin', function ($user) {
            return $user->isAdmin();
        });

        if (!app()->runningInConsole() || !app()->runningUnitTests()) {
            /** @var PermissionRepository $permissionRepository */
            $permissionRepository = app(PermissionRepository::class);
            $permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
            $permissions = $permissionRepository->all();
            foreach ($permissions as $p) {
                \Gate::define("{$p->name}/{$p->resource_name}", function ($user) use ($p) {
                    return $user->hasRole($p->roles);
                });
            }
        }
    }

}
