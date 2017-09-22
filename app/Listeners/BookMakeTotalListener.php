<?php namespace CodePub\Listeners;

use CodeEdu\Book\Events\BookPreIndexEvent;
use CodeEdu\Book\Models\Book;
use CodeEdu\Store\Repositories\Contracts\OrderRepository;

class BookMakeTotalListener
{
    /**
     * @var OrderRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OrderRepository $repository)
    {
        //
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  BookPreIndexEvent  $event
     * @return void
     */
    public function handle(BookPreIndexEvent $event)
    {
        $ranking = $this->repository
            ->findWhere([
                'orderable_id' => $event->getBook()->id,
                'orderable_type' => Book::class
            ])->count();

        $event->setRanking($ranking);
    }
}
