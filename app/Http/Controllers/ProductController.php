<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\GoodsReceipt;
use App\Models\Provider;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $products = $this->product->search($request->search)->paginate();
        }else{
            $products = $this->product->orderBy('id', 'ASC')->paginate(15);
        }

        $filters = $request->except('_token');
        return view('produtos.index',compact('products','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('produtos.store');
        $title  = 'Criar um novo Produto';
        $categories = Category::where('status', 1)->select(['id','description'])->get();
        $providers  = Provider::where('status', 1)->select(['id','name'])->get();
        $warehouses = Warehouse::where('status', 1)->select(['id','description'])->get();

        return view('produtos.form', compact('action', 'title','categories','providers','warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data   = $request->except(['_token','_method']);

        // Gravar a foto e pegando o caminho onde ela foi salva.
        if ($request->file('image')){
            $image  = $request->file('image');
            $folder = str_replace([' ', '-'], '_', mb_strtoupper($request->description, 'UTF-8'));
            $path   = "images/products/$request->code-$folder";
            $return = $image->store($path,'public');
            $data['image'] = $return;
        }

        // Cria o produto
        $product = $this->product->create($data);
        // da entrada de mercadoria
        GoodsReceipt::create([
            'value'      => $request->unitaryValue,
            'date'       => date('Y-m-d'),
            'amount'     => $request->stock,
            'product_id' => $product->id
        ]);

        return to_route('produtos.index')->with('success','Produto cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with(['category:id,description','provider:id,name','warehouse:id,description'])->find($id);
        return view('produtos.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->with(['category:id,description','provider:id,name','warehouse:id,description'])->find($id);

        $action = route('produtos.update', $product->id);
        $title  = "Editar Produto #$product->code";
        $categories = Category::where('status', 1)->select(['id','description'])->get();
        $providers  = Provider::where('status', 1)->select(['id','name'])->get();
        $warehouses = Warehouse::where('status', 1)->select(['id','description'])->get();

        return view('produtos.form', compact('product','action', 'title','categories','providers','warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = $this->product->find($id);
        // $request->validate($employee->rules());
        $data = $request->except(['_token','_method']);

        if ($request->file('image')){
            //verificando se existia imagem anterior
            if ($product->image) {
                Storage::disk('public')->delete($product->image); //remove a imagem anterior
            }
            $image  = $request->file('image');
            $folder = str_replace([' ', '-'], '_', mb_strtoupper($request->description, 'UTF-8'));
            $path   = "images/products/$request->code-$folder";
            $return = $image->store($path,'public');
            $data['image'] = $return;
        }
        $product->update($data);

        return to_route('produtos.index')->with('success','Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image); // removendo a imagem
        }
        $product->delete();

        return to_route('produtos.index')->with('success','Produto removido com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        if ($request->search) {
            $products = $this->product->search($request->search)
                ->with(['category:id,description','provider:id,name'])
                ->orderBy('id', 'ASC')->get();
        }else{
            $products = $this->product
                ->with(['category:id,description','provider:id,name'])
                ->orderBy('id', 'ASC')->get();
        }

        $dom_pdf = PDF::loadView('produtos.pdf', compact('products'));
        return $dom_pdf->download('Lista_de_produtos.pdf');
    }
}
