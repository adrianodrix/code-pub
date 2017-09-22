<?php

namespace CodePub\Providers;

use Aws\GameLift\Exception\GameLiftException;
use CodeEdu\Store\Repositories\Contracts\OrderRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodePub\Model' => 'CodePub\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('book-download', function ($user, $bookId) {
            $orderRepository = app(OrderRepository::class);
            $order = $orderRepository
                ->findWhere([
                    'orderable_id' => $bookId,
                    'user_id' => auth()->user()->id
                ])
                ->first();
            return $order ? true : false;
        });
    }
}
