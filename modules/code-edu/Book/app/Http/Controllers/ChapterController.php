<?php namespace CodeEdu\Book\Http\Controllers;

use CodeEdu\Book\Http\Requests\ChapterCreateRequest;
use CodeEdu\Book\Http\Requests\ChapterUpdateRequest;
use CodeEdu\Book\Models\Book;
use CodeEdu\Book\Repositories\Contracts\BookRepository;
use CodeEdu\Book\Repositories\Contracts\ChapterRepository;
use CodeEdu\Book\Repositories\Criterias\FindByBookCriteria;
use CodeEdu\Book\Repositories\Criterias\OrderByOrderCriteria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use CodeEdu\User\Annotations\Mapping as Permission;

/**
 * Class ChapterController
 * @Permission\Controller(name="books", description="Livros")
 * @package CodeEdu\Book\Http\Controllers
 */
class ChapterController extends Controller
{
    /**
     * @var \CodeEdu\Book\Repositories\Contracts\ChapterRepository
     */
    private $repository;
    /**
     * @var \CodeEdu\Book\Repositories\Contracts\BookRepository
     */
    private $bookRepository;

    /**
     * ChaptersController constructor.
     * @param \CodeEdu\Book\Repositories\Contracts\ChapterRepository $repository
     * @param BookRepository $bookRepository
     */
    public function __construct(ChapterRepository $repository, BookRepository $bookRepository)
    {
        $this->repository = $repository;
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="index", description="Consultar")
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param $id
     */
    public function index(Request $request, Book $book)
    {
        $search = $request->get('search');
        $this->repository
            ->pushCriteria(new FindByBookCriteria($book->id))
            ->pushCriteria(new OrderByOrderCriteria());

        $chapters = $this->repository->paginate(5);
        return view('codeedubook::chapters.index', compact('chapters', 'search', 'book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="new", description="Novo")
     * @param Book $book
     * @return Response
     * @internal param $id
     */
    public function create(Book $book)
    {
        return view('codeedubook::chapters.create', compact('book'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="new", description="Novo")
     * @param  ChapterCreateRequest $request
     * @param Book $book
     * @return Response
     * @internal param $id
     */
    public function store(ChapterCreateRequest $request, Book $book)
    {
        $data = $request->all();
        $data['book_id'] = $book->id;
        $this->repository->create($data);

        $url = $request->get('redirect_to', route('books.chapters.index', ['book' => $book->id]));
        $request->session()->flash('message', ['type' => 'info', 'message' => 'Novo capítulo foi criado.']);
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param Book $book
     * @param $chapterId
     * @return Response
     */
    public function edit(Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBookCriteria($book->id));
        $chapter = $this->repository->find($chapterId);
        return view('codeedubook::chapters.edit', compact('chapter', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param  ChapterUpdateRequest $request
     * @param Book $book
     * @param $chapterId
     * @return Response
     */
    public function update(ChapterUpdateRequest $request, Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBookCriteria($book->id));

        $data = $request->except(['book_id']);
        $this->repository->update($data, $chapterId);

        $url = $request->get('redirect_to', route('books.index', ['book' => $book->id]));
        $request->session()->flash('message', 'O capítulo foi alterado.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="delete", description="Excluir")
     * @param Book $book
     * @param $chapterId
     * @return Response
     */
    public function destroy(Book $book, $chapterId)
    {
        $this->repository->pushCriteria(new FindByBookCriteria($book->id));
        $this->repository->delete($chapterId);

        \Session::flash('message', ['type' => 'warning', 'message' => 'Capítulo foi excluído.']);
        return redirect()->to(\URL::previous());
    }
}
