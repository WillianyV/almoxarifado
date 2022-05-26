<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DepartmentController extends Controller
{
    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $departments = $this->department->search($request->search)->paginate();
        }else{
            $departments = $this->department->orderBy('id', 'ASC')->paginate(15);
        }
        $filters = $request->except('_token');
        return view('setor.index',compact('departments','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('setor.store');
        $title  = 'Criar um novo setor';

        return view('setor.form', compact('action', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        $data = $request->except(['_token','_method']);

        $this->department->create($data);

        return to_route('setor.index')->with('success','Setor cadastrado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = $this->department->find($id);
        $action = route('setor.update', $department->id);
        $title  = 'Editar Setor: ' . $department->description;
        return view('setor.form', compact('department', 'action', 'title'));
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
        $department = $this->department->find($id);
        $request->validate($department->rules());
        $data = $request->except(['_token','_method']);
        $department->update($data);

        return to_route('setor.index')->with('success','Setor atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = $this->department->find($id);
        $department->delete();

        return to_route('setor.index')->with('success','Setor removido com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        $departments = $this->department->exports($request->search);
        $dom_pdf     = PDF::loadView('setor.pdf', compact('departments'));
        return $dom_pdf->download('Lista_de_setores.pdf');
    }
}
