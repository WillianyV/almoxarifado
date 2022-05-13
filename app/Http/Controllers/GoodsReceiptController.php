<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceipt;
use App\Http\Requests\StoreGoodsReceiptRequest;
use App\Http\Requests\UpdateGoodsReceiptRequest;
use App\Models\Product;

class GoodsReceiptController extends Controller
{
    public function __construct(GoodsReceipt $goodsReceipt)
    {
        $this->goodsReceipt = $goodsReceipt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $products = Product::where('status', 1)->select(['id','description'])->get();
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
        $this->goodsReceipt->create($request->except(['_token','_method']));

        return to_route('entrada-de-mercadorias.index')->with('success','Entrada de mercadoria cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoodsReceipt  $goodsReceipt
     * @return \Illuminate\Http\Response
     */
    public function show(GoodsReceipt $goodsReceipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoodsReceipt  $goodsReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodsReceipt $goodsReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGoodsReceiptRequest  $request
     * @param  \App\Models\GoodsReceipt  $goodsReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGoodsReceiptRequest $request, GoodsReceipt $goodsReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoodsReceipt  $goodsReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodsReceipt $goodsReceipt)
    {
        //
    }
}
