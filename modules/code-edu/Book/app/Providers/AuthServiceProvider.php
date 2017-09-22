<?php

namespace CodeEdu\Book\Providers;

use CodeEdu\Book\Models\Book;
use CodeEdu\Book\Policies\BookPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Book::class => BookPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
