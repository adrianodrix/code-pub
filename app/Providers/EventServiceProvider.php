<?php namespace CodePub\Providers;

use CodeEdu\Book\Events\BookPreIndexEvent;
use CodeEdu\Store\Events\OrderPostProcessEvent;
use CodePub\Listeners\BookMakeTotalListener;
use CodePub\Listeners\BookRankingUpdateListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        BookPreIndexEvent::class => [
            BookMakeTotalListener::class
        ],
        OrderPostProcessEvent::class => [
            BookRankingUpdateListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
