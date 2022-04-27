@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4>Produto: #{{ $product->code }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-8 mb-3">
                            <fieldset disabled>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label for="description" class="form-label">Descrição</label>
                                        <input type="text" class="form-control" name="description" value="{{ $product->description }}">
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <label for="stock" class="form-label">Estoque</label>
                                        <input type="text" class="form-control" name="stock" value="{{ $product->stock }}">
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <label for="minimumStock" class="form-label">Estoque Mínimo</label>
                                        <input type="text" class="form-control" name="minimumStock" value="{{ $product->minimumStock }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label for="category_id" class="form-label">Categoria</label>
                                        <input type="text" class="form-control" name="category_id" value="{{ $product->category->description }}">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="provider_id" class="form-label">Fornecedor</label>
                                        <input type="text" class="form-control" name="provider_id" value="{{ $product->provider->name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label for="warehouse_id" class="form-label">Almoxarifado</label>
                                        <input type="text" class="form-control" name="warehouse_id" value="{{ $product->warehouse->description }}">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" name="status" value="{{ $product->status}}">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-sm-4 mb-3 align-self-center text-center">
                            @if ($product->image != null)
                                <img src="{{ url("storage/$product->image") }}" class="img-fluid" id="productImage" alt="{{ $product->description }}">
                            @else
                                <img src="{{ asset('img/default.png') }}" class="img-fluid" id="productImage" alt="{{ $product->description }}">
                            @endif
                        </div>
                    </div>
                    <!-- The Modal -->
                    <div id="productImageModal" class="productModal">
                        <span class="close">&times;</span>
                        <img class="productModal-content" id="img01">
                        <div id="caption"></div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('produtos.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
