<?php

namespace CodePub\Http\Controllers;

use CodePub\Models\Book;
use CodePub\Repositories\Contracts\BookRepository;
use CodePub\Repositories\Criterias\FindOnlyTrashedCriteria;
use Illuminate\Http\Request;

class BookTrashedController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BookTrashedController constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $books = $this->repository->onlyTrashed()->paginate(5);
        return view('trashed.books.index',compact('books', 'search'));
    }

    /**
     * Mostra o livro da lixeira
     *
     * @Permission\Action(name="list", description="View the Book")
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);
        return view('trashed.books.show', compact('book'));
    }

    /**
     * Restauração de Livros
     *
     * @Permission\Action(name="restore", description="Book Restoration")
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        $this->repository->onlyTrashed()->restore($id);

        $url = $request->get('redirect_to', route('trashed.books.index'));

        $request->session()->flash('message', ['type' => 'success', 'message' => 'O livro foi restaurado com sucesso']);
        return redirect()->to($url);
    }
}
