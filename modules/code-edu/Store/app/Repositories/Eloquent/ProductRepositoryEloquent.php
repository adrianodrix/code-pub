<?php namespace CodeEdu\Store\Repositories\Eloquent;

use CodeEdu\Book\Repositories\Eloquent\BookRepositoryEloquent;
use CodeEdu\Store\Repositories\Contracts\CategoryRepository;
use CodeEdu\Store\Repositories\Contracts\ProductRepository;

class ProductRepositoryEloquent extends BookRepositoryEloquent implements ProductRepository
{

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function boot()
    {
        $this->categoryRepository = app(CategoryRepository::class);

        parent::boot();
    }


    public function home()
    {
        //return $this->model->where('published', 1)->paginate(12)->items();
        return $this->model->where('published', 1)->take(12)->get();
    }

    public function findByCategory($id)
    {
        $category = $this->categoryRepository->find($id);
        return $category->books()
            ->where('published', 1)
            ->get();
    }

    public function findBySlug($slug)
    {
        return $this->model->findBySlugOrFail($slug);
    }

    public function makeProductStore($id)
    {
        // TODO: Implement makeProductStore() method.
    }

    public function like($search)
    {
        return $this->model
            ->where('title', 'like', "%{$search}%")
            ->where('published', 1)
            ->get();
    }
}