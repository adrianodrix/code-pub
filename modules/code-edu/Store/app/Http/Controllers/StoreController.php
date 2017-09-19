<?php namespace CodeEdu\Store\Http\Controllers;

use CodeEdu\Book\Models\Book;
use CodeEdu\Store\Repositories\Contracts\CategoryRepository;
use CodeEdu\Store\Repositories\Contracts\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

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
     * StoreController constructor.
     * @param ProductRepository $products
     * @param CategoryRepository $categories
     */
    public function __construct(ProductRepository $products, CategoryRepository $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    public function index()
    {
        $products = $this->products->home();
        return view('codeedustore::store.home', compact('products'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug)
    {
        $category = $this->categories->findWhere(['slug' => $slug])->first();
        $products = $this->products->findByCategory($category->id);
        return view('codeedustore::store.category', compact('products', 'category'));
    }

    public function search(Request $request) {
        $search = $request->get('q');
        $products = $this->products->like($search);
        return view('codeedustore::store.search', compact('products', 'search'));
    }

    public function showProduct($slug){
        $product = $this->products->findBySlug($slug);
        return view('codeedustore::store.show-product', compact('product'));
    }
}
