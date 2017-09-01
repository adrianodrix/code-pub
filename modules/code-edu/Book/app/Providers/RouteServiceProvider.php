<?php

namespace CodeEdu\Book\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $rootUrlNamespace = 'CodeEdu\Book\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @param  Router $router
     * @return void
     */
    public function before(Router $router)
    {
        //
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
         if (!app()->routesAreCached()) {
             $router->group([
                 'middleware' => 'web',
                 'namespace' => $this->rootUrlNamespace
             ], function() {
                 require __DIR__ . '/../Http/routes.php';
             });
         }
    }
}