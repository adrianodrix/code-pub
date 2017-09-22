<?php namespace CodeEdu\Store\Http\Controllers;

use CodeEdu\Book\Models\Book;
use CodeEdu\Store\Repositories\Contracts\CategoryRepository;
use CodeEdu\Store\Repositories\Contracts\OrderRepository;
use CodeEdu\Store\Repositories\Contracts\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Stripe\Error\Card;

class StoreController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $products;
    /**
     * @var CategoryRepository
     */
    private $categories;
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * StoreController constructor.
     * @param ProductRepository $products
     * @param CategoryRepository $categories
     * @param OrderRepository $orderRepository
     */
    public function __construct(ProductRepository $products,
                                CategoryRepository $categories,
                                OrderRepository $orderRepository)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $products = $this->products->home();
        return view('codeedustore::store.home', compact('products'));
    }

    /**
     * Search products by Category
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug)
    {
        $category = $this->categories->findWhere(['slug' => $slug])->first();
        $products = $this->products->findByCategory($category->id);
        return view('codeedustore::store.category', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $search = $request->get('q');
        $products = $this->products->like($search);
        return view('codeedustore::store.search', compact('products', 'search'));
    }

    public function showProduct($slug)
    {
        $product = $this->products->findBySlug($slug);
        return view('codeedustore::store.show-product', compact('product'));
    }

    public function checkout($slug)
    {
        $product = $this->products->findBySlug($slug);
        return view('codeedustore::store.checkout', compact('product'));
    }

    public function process(Request $request, $slug)
    {
        $product = $this->products->findBySlug($slug);
        $productStore = $this->products->makeProductStore($product->id);
        $user = $request->user();
        $token = $request->get('stripeToken');
        try {
            $order = $this->orderRepository->process($token, $user, $productStore);
            $status = true;
        } catch (Card $exception) {
            $status = false;
        }
        return view('codeedustore::store.process', compact('order', 'status'));
    }

    public function orders()
    {
        $orders = $this->orderRepository->findWhere(['user_id' => auth()->user()->id])->all();
        return view('codeedustore::store.orders', compact('orders'));
    }
}
