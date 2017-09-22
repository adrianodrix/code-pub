<?php namespace CodePub\Listeners;

use CodeEdu\Store\Events\OrderPostProcessEvent;

class BookRankingUpdateListener
{

    /**
     * Handle the event.
     *
     * @param  OrderPostProcessEvent  $event
     * @return void
     */
    public function handle(OrderPostProcessEvent $event)
    {
        $order = $event->getOrder();
        $order->orderable()->searchable();
    }
}
