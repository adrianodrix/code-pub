<?php namespace CodeEdu\Store\Providers;

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
        $this->app->bind(\CodeEdu\Store\Repositories\Contracts\CategoryRepository::class, \CodeEdu\Store\Repositories\Eloquent\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodeEdu\Store\Repositories\Contracts\ProductRepository::class, \CodeEdu\Store\Repositories\Eloquent\ProductRepositoryEloquent::class);
        //:end-bindings;
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
