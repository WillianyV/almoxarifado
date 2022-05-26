<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $categories =  $this->category->search($request->search)->paginate();
        }else{
            $categories =  $this->category->orderBy('id', 'ASC')->paginate(1);
        }
        $filters = $request->except('_token');
        return view('categoria.index',compact('categories','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('categoria.store');
        $title  = 'Criar uma nova categoria';

        return view('categoria.form', compact('action', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except(['_token','_method']);

        $this->category->create($data);

        return to_route('categoria.index')->with('success','Categoria cadastrada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);
        $action = route('categoria.update', $category->id);
        $title  = 'Editar categoria: ' . $category->description;
        return view('categoria.form', compact('category', 'action', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = $this->category->find($id);
        $request->validate($category->rules());
        $data = $request->except(['_token','_method']);
        $category->update($data);

        return to_route('categoria.index')->with('success','Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->find($id);
        $category->delete();

        return to_route('categoria.index')->with('success','Categoria removida com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        $categories = $this->category->exports($request->search);
        $dom_pdf    = PDF::loadView('categoria.pdf', compact('categories'));
        return $dom_pdf->download('Lista_de_categorias.pdf');
    }
}
