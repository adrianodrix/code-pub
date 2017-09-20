<?php namespace CodeEdu\Store\Repositories\Eloquent;

use CodeEdu\Store\Models\Order;
use CodeEdu\Store\Models\ProductStore;
use CodeEdu\Store\Repositories\Contracts\OrderRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Stripe\Invoice;

/**
 * Class OrderRepositoryEloquent
 * @package CodeEdu\Store\Repositories\Eloquent
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function process($token, $user, ProductStore $productStore)
    {
        $this->createCustomer($token, $user);

        /** @var  Invoice $invoice */
        $invoice = $user->invoiceFor(
            "{{$productStore->getId()}} {{$productStore->getName()}}",
            $productStore->getPrice() * 100
        );

        $order = $this->create([
            'date_launch' => (New \DateTime())->format('Y-m-d'),
            'price' => $productStore->getPrice(),
            'user_id' => $user->id,
            'invoice_id' => $invoice->id
        ]);

        $order->orderable()->associate($productStore->getProductOriginal());
        $order->save();

        return $order;
    }

    protected function createCustomer($token, $user)
    {
        if(!$user->stripe_id) {
            $user->createAsStripeCustomer($token);
        }
        $user->updateCard($token);
    }
}