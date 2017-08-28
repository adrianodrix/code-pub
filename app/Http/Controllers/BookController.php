<?php

namespace CodePub\Http\Controllers;

use CodePub\Http\Requests\BookRequest;
use CodePub\Repositories\Contracts\BookRepository;

class BookController extends Controller
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BookController constructor.
     *
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
    public function index()
    {
        $books = $this->repository->orderBy('id','desc')->paginate();
        return view('books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $this->repository->create($request->all());

        $request->session()->flash('message', ['type' => 'success', 'message' => 'Novo Livro foi criado com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('books.index')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(BookRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        $request->session()->flash('message', ['type' => 'success', 'message' => 'O Livro foi atualizado com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('books.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        \Session::flash('message', ['type' => 'warning', 'message' => 'Livro foi excluido com sucesso.']);
        return redirect()->to(\URL::previous());
    }
}
