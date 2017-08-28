<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::query()->orderBy('id','desc')->paginate(10);
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
        Book::create($request->all());
        $request->session()->flash('message', ['type' => 'success', 'message' => 'Novo Livro foi criado com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('books.index')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest|\Illuminate\Http\Request $request
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(BookRequest $request, Book $book)
    {

        $book->update($request->all());
        $request->session()->flash('message', ['type' => 'success', 'message' => 'O Livro foi atualizado com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('books.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Book $book)
    {
        $book->delete();
        \Session::flash('message', ['type' => 'warning', 'message' => 'Livro foi excluido com sucesso.']);
        return redirect()->to(\URL::previous());
    }
}
