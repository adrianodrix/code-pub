<?php

namespace CodeEdu\Book\Http\Controllers;

use CodeEdu\Book\Http\Requests\CategoryRequest;
use CodeEdu\Book\Repositories\Contracts\CategoryRepository;
use CodeEdu\User\Annotations\Mapping as Permission;

/**
 * Class BookController
 *
 * @Permission\Controller(name="categories", description="Categorias")
 * @package CodeEdu\Book\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;


    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @Permission\Action(name="index", description="Consultar")
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->orderBy('id', 'desc')->paginate();
        return view("codeedubook::categories.index",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @Permission\Action(name="new", description="Novo")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @Permission\Action(name="new", description="Novo")
     * @param \CodeEdu\Book\Http\Requests\CategoryRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());

        $request->session()->flash('message', ['type' => 'success', 'message' => 'Categoria cadastrada com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('categories.index')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('codeedubook::categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @Permission\Action(name="update", description="Editar")
     * @param CategoryRequest|\Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        $request->session()->flash('message', ['type' => 'success', 'message' => 'Categoria atualizada com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('categories.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @Permission\Action(name="delete", description="Excluir")
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        \Session::flash('message', ['type' => 'warning', 'message' => 'Categoria foi excluida com sucesso.']);
        return redirect()->to(\URL::previous());
    }
}
