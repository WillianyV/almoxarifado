<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceipt;
use App\Http\Requests\StoreGoodsReceiptRequest;
use App\Http\Requests\UpdateGoodsReceiptRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GoodsReceiptController extends Controller
{
    public function __construct(GoodsReceipt $goodsReceipt, Product $product)
    {
        $this->goodsReceipt = $goodsReceipt;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goodsReceipts = $this->goodsReceipt->with('product:id,description')->orderBy('id','DESC')->paginate(15);
        return view('entrada-de-mercadorias.index', compact('goodsReceipts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action   = route('entrada-de-mercadorias.store');
        $title    = 'Entrada de Mercadorias';
        $products = $this->product->where('status', 1)->select(['id','description'])->get();
        return view('entrada-de-mercadorias.form', compact('action', 'title','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGoodsReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsReceiptRequest $request)
    {
        $data       = $request->except(['_token','_method']);
        $totalValue =  $this->goodsReceipt->calculateTotalValue($request->value, $request->amount);
        $data       = Arr::add($data, 'totalValue', $totalValue);
        $this->goodsReceipt->create($data);

        $this->product->updateStock($request->product_id, $request->amount);

        return to_route('entrada-de-mercadorias.index')->with('success','Entrada de mercadoria cadastrada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goodsReceipt = $this->goodsReceipt->find($id);

        $date         = Carbon::createfromformat("d/m/Y", $goodsReceipt->date)->format('Y-m-d');
        $goodsReceipt = Arr::add($goodsReceipt, 'dateFormat', $date);

        $action   = route('entrada-de-mercadorias.update', $id);

        $title    = 'Edição da Entrada da Mercadoria';
        $products = $this->product->where('status', 1)->select(['id','description'])->get();

        return view('entrada-de-mercadorias.form', compact('goodsReceipt','action', 'title','products'));
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
        $goodsReceipt = $this->goodsReceipt->find($id);
        //Remove a quantidade anterior
        $this->product->updateStock($goodsReceipt->product_id, $goodsReceipt->amount, false);

        $data       = $request->except(['_token','_method']);
        $totalValue =  $this->goodsReceipt->calculateTotalValue($request->value, $request->amount);
        $data       = Arr::add($data, 'totalValue', $totalValue);
        $goodsReceipt->update($data);

        $this->product->updateStock($request->product_id, $request->amount);
        return to_route('entrada-de-mercadorias.index')->with('success','Entrada atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goodsReceipt = $this->goodsReceipt->find($id);
        //Remove a quantidade anterior
        $this->product->updateStock($goodsReceipt->product_id, $goodsReceipt->amount, false);
        $goodsReceipt->delete();
        return to_route('entrada-de-mercadorias.index')->with('success','Entrada removida com sucesso.');
    }
}
