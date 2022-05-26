<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Http\Requests\StoreProviderRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProviderController extends Controller
{
    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $providers = $this->provider->search($request->search)->paginate();
        }else{
            $providers = $this->provider->orderBy('id', 'ASC')->paginate(15);
        }
        $filters = $request->except('_token');
        return view('fornecedor.index',compact('providers','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('fornecedor.store');
        $title  = 'Criar um novo fornecedor';

        return view('fornecedor.form', compact('action', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProviderRequest $request)
    {
        $data = $request->except(['_token','_method']);

        $this->provider->create($data);

        return to_route('fornecedor.index')->with('success','Fornecedor cadastrado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = $this->provider->find($id);
        $action = route('fornecedor.update', $provider->id);
        $title  = 'Editar Fornecedor: ' . $provider->description;
        return view('fornecedor.form', compact('provider', 'action', 'title'));
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
        $provider = $this->provider->find($id);
        $request->validate($provider->rules());
        $data = $request->except(['_token','_method']);
        $provider->update($data);

        return to_route('fornecedor.index')->with('success','Fornecedor atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = $this->provider->find($id);
        $provider->delete();
        return to_route('fornecedor.index')->with('success','Fornecedor removido com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        $providers   = $this->provider::exports($request->search);
        $dom_pdf = PDF::loadView('fornecedor.pdf', compact('providers'));
        return $dom_pdf->download('Lista_de_fornecedores.pdf');
    }
}
