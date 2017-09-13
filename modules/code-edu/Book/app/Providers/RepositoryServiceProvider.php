<?php

namespace CodeEdu\Book\Providers;

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
        $this->app->bind(\CodeEdu\Book\Repositories\Contracts\CategoryRepository::class, \CodeEdu\Book\Repositories\Eloquent\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodeEdu\Book\Repositories\Contracts\BookRepository::class, \CodeEdu\Book\Repositories\Eloquent\BookRepositoryEloquent::class);
        $this->app->bind(\CodeEdu\Book\Repositories\Contracts\ChapterRepository::class, \CodeEdu\Book\Repositories\Eloquent\ChapterRepositoryEloquent::class);
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
