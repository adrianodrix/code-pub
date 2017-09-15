<?php namespace CodeEdu\Book\Http\Controllers;

use CodeEdu\Book\Http\Requests\CoverRequest;
use CodeEdu\Book\Models\Book;
use CodeEdu\Book\Services\CoverUpload;
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
     * @param  CoverRequest $request
     * @return Response
     */
    public function store(CoverRequest $request, Book $book, CoverUpload $upload)
    {
        $upload->upload($book, $request->file('file'));

        $url = $request->get('redirect_to', route('books.index'));
        return redirect()
            ->to($url)
            ->with('message', ['type' => 'info', 'message' => 'Capa de livro salva com sucesso!']);
    }
}
