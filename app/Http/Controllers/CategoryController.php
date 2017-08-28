<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::query()->orderBy('id','desc')->paginate(10);
        return view("categories.index",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        $request->session()->flash('message', ['type' => 'success', 'message' => 'Categoria cadastrada com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('categories.index')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest|\Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        $request->session()->flash('message', ['type' => 'success', 'message' => 'Categoria atualizada com sucesso.']);
        return redirect()->to($request->get('redirect_to', route('categories.index')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Category $category)
    {
        $category->delete();
        \Session::flash('message', ['type' => 'warning', 'message' => 'Categoria foi excluida com sucesso.']);
        return redirect()->to(\URL::previous());
    }
}
