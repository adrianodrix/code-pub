<?php

namespace CodePub\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodePub\Repositories\Contracts\CategoryRepository::class, \CodePub\Repositories\Eloquent\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodePub\Repositories\Contracts\BookRepository::class, \CodePub\Repositories\Eloquent\BookRepositoryEloquent::class);
        //:end-bindings:
    }
}
