<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $roles = Role::search($request->search)->paginate();
        }else{
            $roles = Role::orderBy('id', 'ASC')->paginate(15);
        } 
        $filters = $request->except('_token');
        return view('funcao.index',compact('roles','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('funcao.store');
        $title  = 'Criar uma nova função';

        return view('funcao.form', compact('action', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->except(['_token','_method']);

        Role::create($data);

        return to_route('funcao.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role->find($id);
        $action = route('funcao.update', $role->id);
        $title  = 'Editar Função: ' . $role->description;
        return view('funcao.form', compact('role', 'action', 'title'));
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
        $role = $this->role->find($id); 
        $request->validate($role->rules());
        $data = $request->except(['_token','_method']);
        $role->update($data);

        return to_route('funcao.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role->find($id);
        $role->delete();
        return to_route('funcao.index');
    }

    public function exportToPdf(Request $request)
    {
        $roles   = $this->role::exports($request->search);
        $dom_pdf = PDF::loadView('funcao.pdf', compact('roles'));  
        return $dom_pdf->download('Lista_de_funcoes.pdf');
    }
}
