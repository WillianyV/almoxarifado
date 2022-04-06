<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;

class WarehouseController extends Controller
{
    public function __construct(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $warehouses = Warehouse::search($request->search)->paginate();
        }else{
            $warehouses = Warehouse::orderBy('id', 'ASC')->paginate(15);
        }
        $filters = $request->except('_token');
        return view('almoxarifado.index',compact('warehouses','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('almoxarifado.store');
        $title  = 'Criar um novo Almoxarifado';

        return view('almoxarifado.form', compact('action', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        $data = $request->except(['_token','_method']);

        $address = Address::create($data);

        $data = Arr::add($data, 'address_id', $address->id);

        Warehouse::create($data);

        return to_route('almoxarifado.index')->with('success','Almoxarifado cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = $this->warehouse->with(['address'])->find($id);

        return view('almoxarifado.show',compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = $this->warehouse->with(['address'])->find($id);
        $action = route('almoxarifado.update', $warehouse->id);
        $title  = 'Editar Almoxarifado: ' . $warehouse->description;
        return view('almoxarifado.form', compact('warehouse', 'action', 'title'));
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
        $warehouse = $this->warehouse->find($id);
        $request->validate($warehouse->rules());
        $data = $request->except(['_token','_method']);

        $address = Address::find($warehouse->address_id);

        $address->update($data);

        $warehouse->update($data);

        return to_route('almoxarifado.index')->with('success','Almoxarifado atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse = $this->warehouse->find($id);
        $warehouse->delete();
        return to_route('almoxarifado.index')->with('success','Almoxarifado removido com sucesso.');
    }


    public function exportToPdf(Request $request)
    {
        $warehouses   = $this->warehouse::exports($request->search);
        $dom_pdf = PDF::loadView('almoxarifado.pdf', compact('warehouses'));
        return $dom_pdf->download('Lista_de_almoxarifados.pdf');
    }
}
