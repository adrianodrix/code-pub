<?php

namespace CodeEdu\Book\Http\Controllers;

use CodeEdu\Book\Http\Requests\BookRequest;
use CodeEdu\Book\Repositories\Contracts\BookRepository;
use CodeEdu\Book\Repositories\Contracts\CategoryRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * BookController constructor.
     *
     * @param BookRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $books = $this->repository->orderBy('id','desc')->paginate();
        return view('codeedubook::books.index',compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->withTrashed()->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);

        $request->session()->flash('message', ['type' => 'success', 'message' => 'Novo Livro foi criado com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('books.index')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     * @internal param int $id
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);
        if (!\Gate::allows('update-book', $book)) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        $categories = $this->categoryRepository->withTrashed()->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.edit',compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \CodeEdu\Book\Http\Requests\BookRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(BookRequest $request, $id)
    {
        $data = $request->except(['author_id']);
        $this->repository->update($data, $id);

        $request->session()->flash('message', ['type' => 'success', 'message' => 'O Livro foi atualizado com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('books.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     * @internal param int $id
     */
    public function destroy($id)
    {
        $book = $this->repository->find($id);
        if ($book->author->id != \Auth::user()->id) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        $this->repository->delete($id);

        \Session::flash('message', ['type' => 'warning', 'message' => 'Livro foi excluido com sucesso.']);
        return redirect()->to(\URL::previous());
    }
}
