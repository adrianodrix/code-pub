<?php namespace CodeEdu\Book\Http\Controllers;

use CodeEdu\Book\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use CodeEdu\User\Annotations\Mapping as Permission;

/**
 * Class CoverController
 * @Permission\Controller(name="books", description="Livros")
 * @package CodeEdu\Book\Http\Controllers
 */
class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('book::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="update", description="Editar")
     * @return Response
     */
    public function create(Book $book)
    {
        return view('codeedubook::books.cover', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('book::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('book::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
