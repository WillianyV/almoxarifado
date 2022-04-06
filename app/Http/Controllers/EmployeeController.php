<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $employees = $this->employee->search($request->search)->paginate();
        }else{
            $employees = $this->employee->orderBy('id', 'ASC')->paginate(15);
        }
        $filters = $request->except('_token');
        return view('funcionario.index',compact('employees','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('funcionario.store');
        $title  = 'Criar um novo Funcionário';
        $roles  = Role::where('status',true)->select(['id','description'])->get();
        $departments = Department::where('status',true)->select(['id','description'])->get();
        $companies   = Company::where('status',true)->select(['id','fantasyName'])->get();
        return view('funcionario.form', compact('action', 'title','roles','departments','companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->except(['_token','_method']);

        $this->employee->create($data);

        return to_route('funcionario.index')->with('success','Funcionário cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = $this->employee->find($id);
        return view('funcionario.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->employee->find($id);
        $action   = route('usuario.update', $employee->id);
        $title    = 'Editar usuário: ' . $employee->name;
        $roles    = Role::where('status',true)->select(['id','description'])->get();
        $departments = Department::where('status',true)->select(['id','description'])->get();
        $companies   = Company::where('status',true)->select(['id','fantasyName'])->get();
        return view('funcionario.form', compact('employee','action', 'title','roles','departments','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = $this->employee->find($id);
        $request->validate($employee->rules());
        $data = $request->except(['_token','_method']);
        $employee->update($data);

        return to_route('funcionario.index')->with('success','Funcionário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = $this->employee->find($id);
        $employee->delete();

        return to_route('funcionario.index')->with('success','Funcionário removido com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        $employees   = $this->employee::exports($request->search);
        $dom_pdf = PDF::loadView('funcionario.pdf', compact('employees'));
        return $dom_pdf->download('Lista_de_funcionarios.pdf');
    }
}
