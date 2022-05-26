<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Address;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function __construct(Company $company, Warehouse $warehouse, Address $address)
    {
        $this->company   = $company;
        $this->warehouse = $warehouse;
        $this->address   = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $companies = $this->company->search($request->search)->paginate();
        }else{
            $companies = $this->company->orderBy('id', 'ASC')->paginate(15);
        }
        $filters = $request->except('_token');
        return view('empresa.index',compact('companies','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('empresa.store');
        $title  = 'Criar uma nova empresa';
        $warehouses = $this->warehouse->where('status',true)->select(['id','description'])->get();
        return view('empresa.form', compact('action', 'title', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->except(['_token','_method']);

        $address = $this->address->create($data);

        $data = Arr::add($data, 'address_id', $address->id);

        $this->company->create($data);

        return to_route('empresa.index')->with('success','Empresa cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->company->with(['address'])->find($id);

        return view('empresa.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->company->with(['address'])->find($id);
        $action = route('empresa.update', $company->id);
        $title  = 'Editar Empresa: ' . $company->description;
        $warehouses = $this->warehouse->where('status',true)->select(['id','description'])->get();

        return view('empresa.form', compact('company', 'action', 'title', 'warehouses'));
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
        try {
            DB::beginTransaction();
            $company = $this->company->find($id);
            $request->validate($company->rules());
            $data = $request->except(['_token','_method']);

            $address = $this->address->find($company->address_id);
            $address->update($data);

            $company->update($data);

            DB::commit();
            return to_route('empresa.index')->with('success','Empresa atualizado com sucesso.');
        } catch (Exception $th) {
            DB::rollBack();
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = $this->company->find($id);
        $company->delete();
        return to_route('empresa.index')->with('success','Empresa removido com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        $companies   = $this->company->exports($request->search);
        $dom_pdf = PDF::loadView('empresa.pdf', compact('companies'));
        return $dom_pdf->download('Lista_de_empresas.pdf');
    }
}
