<?php

namespace CodeEdu\Book\Http\Controllers;

use CodeEdu\Book\Http\Requests\BookRequest;
use CodeEdu\Book\Jobs\GenerateBook;
use CodeEdu\Book\Models\Book;
use CodeEdu\Book\Notifications\BookExportedNotification;
use CodeEdu\Book\Repositories\Contracts\BookRepository;
use CodeEdu\Book\Repositories\Contracts\CategoryRepository;
use CodeEdu\Book\Services\BookExport;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use CodeEdu\User\Annotations\Mapping as Permission;

/**
 * Class BookController
 *
 * @Permission\Controller(name="books", description="Livros")
 * @package CodeEdu\Book\Http\Controllers
 */
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
     * @Permission\Action(name="index", description="Consultar")
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
     * @Permission\Action(name="new", description="Novo")
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
     * @Permission\Action(name="new", description="Novo")
     * @param BookRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);

        return redirect()
            ->to($request->get('redirect_to', route('books.index')))
            ->with('message', ['type' => 'success', 'message' => 'Novo Livro foi criado com sucesso.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     * @internal param int $id
     */
    public function edit(Book $book)
    {
        $categories = $this->categoryRepository->withTrashed()->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.edit',compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param \CodeEdu\Book\Http\Requests\BookRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->except(['author_id']);
        $this->repository->update($data, $book->id);

        return redirect()
            ->to($request->get('redirect_to', route('books.index')))
            ->with('message', ['type' => 'success', 'message' => 'O Livro foi atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="delete", description="Excluir")
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     * @internal param int $id
     */
    public function destroy(Book $book)
    {
        $this->repository->delete($book->id);

        return redirect()
            ->to(\URL::previous())
            ->with('message', ['type' => 'warning', 'message' => 'Livro foi excluido com sucesso.']);
    }

    /**
     * Manegement all books
     *
     * @Permission\Action(name="all", description="Gerenciar todos os Livros")
     * @return void
     */
    public function all(){}

    /**
     * Export Book
     *
     * @Permission\Action(name="export", description="Exportar")
     * @param Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function export(Book $book)
    {
        dispatch(new GenerateBook($book));

        return redirect()
            ->route('books.index')
            ->with('message', ['type' => 'success', 'message' => 'Livro esta sendo gerado. Aguarde notificação!']);
    }

    /**
     * Download zip file
     *
     * @Permission\Action(name="download", description="Baixar")
     * @param Book $book
     * @return mixed
     */
    public function download(Book $book)
    {
        return response()->download($book->zip_file);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function downloadCommon($id) {
        $book = $this->repository->skipCriteria()->find($id);

        if(\Gate::allows('book-download', $book->id)){
            return $this->download($book);
        }

        abort(404);
    }
}
