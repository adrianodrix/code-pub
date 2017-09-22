@inject('categoryRepository', 'CodeEdu\Store\Repositories\Contracts\CategoryRepository')
<aside class="col-md-3">
    <a href="#" class="list-group-item disabled">Categorias</a>
    @foreach($categoryRepository->orderBy('name')->all() as $category)
        <a href="{{route('store.category', ['slug' => $category->slug])}}" class="list-group-item">{{$category->name}}</a>
    @endforeach
</aside>