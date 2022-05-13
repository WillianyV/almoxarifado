@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (isset($product))
        <div class="col-md-12">
        @else
        <div class="col-md-8">
        @endif
            <div class="card bg-violet-dark">
                <div class="card-body">
                    <div class="mb-3">
                        <h4>{{ $title }}</h4>
                    </div>
                    <form action="{{ $action }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @isset($product)
                            @method('PUT')
                        @endisset

                        @isset($product)
                            <div class="row">
                                <div class="col-sm-8 mb-3">
                        @endisset
                        <div class="row">
                            <div class="col-sm-2 mb-3">
                                <label for="code" class="form-label">Código</label>
                                <input type="text" class="form-control" name="code" id="code" aria-describedby="codeHelp" value="{{ old('code', $product->code ?? '') }}" required>
                                <div id="codeHelp" class="form-text">Obrigatório.</div>
                                @error('code')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-10 mb-3">
                                <label for="image" class="form-label">Imagem</label>
                                <input class="form-control" type="file" id="image" name="image" aria-describedby="imageHelp">
                                <div id="imageHelp" class="form-text">Não é obrigatório.</div>
                                @error('image')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <input type="text" class="form-control" name="description" id="description" aria-describedby="descriptionHelp" value="{{ old('description', $product->description ?? '') }}" required>
                                <div id="descriptionHelp" class="form-text">Obrigatório.</div>
                                @error('description')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="stock" class="form-label">Estoque</label>
                                <input type="text" class="form-control" name="stock" id="stock" aria-describedby="stockHelp" value="{{ old('stock', $product->stock ?? '') }}" required>
                                <div id="stockHelp" class="form-text">Obrigatório.</div>
                                @error('stock')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="minimumStock" class="form-label">Estoque Mínimo</label>
                                <input type="text" class="form-control" name="minimumStock" id="minimumStock" aria-describedby="minimumStockHelp" value="{{ old('minimumStock', $product->minimumStock ?? '') }}" required>
                                <div id="minimumStockHelp" class="form-text">Obrigatório.</div>
                                @error('minimumStock')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 mb-3">
                                <label for="category_id" class="form-label">Categoria</label>
                                <select class="form-select" name="category_id" id="category_id" aria-describedby="category_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id  ?? '') == $category->id ? 'selected' : ''}}>{{ $category->description }}</option>
                                    @endforeach
                                </select>
                                <div id="category_idHelp" class="form-text">Obrigatório.</div>
                                @error('category_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="provider_id" class="form-label">Fornecedor</label>
                                <select class="form-select" name="provider_id" id="provider_id" aria-describedby="provider_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione</option>
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}" {{ old('provider_id', $product->provider_id  ?? '') == $provider->id ? 'selected' : ''}}>{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                                <div id="provider_idHelp" class="form-text">Obrigatório.</div>
                                @error('provider_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="warehouse_id" class="form-label">Almoxarifado</label>
                                <select class="form-select" name="warehouse_id" id="warehouse_id" aria-describedby="warehouse_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $product->warehouse_id  ?? '') == $warehouse->id ? 'selected' : ''}}>{{ $warehouse->description }}</option>
                                    @endforeach
                                </select>
                                <div id="warehouse_idHelp" class="form-text">Obrigatório.</div>
                                @error('warehouse_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" aria-describedby="statusHelp" required>
                                    <option value="" disabled selected hidden>Selecione</option>
                                    <option value="Ativo" {{ old('status', $product->status  ?? '') ==  'Ativo' ? 'selected' : ''}}>Ativo</option>
                                    <option value="Desativado" {{ old('status', $product->status  ?? '') ==  'Desativado' ? 'selected' : ''}}>Desativado</option>
                                </select>
                                <div id="statusHelp" class="form-text">Obrigatório.</div>
                                @error('status')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        @isset($product)
                                </div>
                                <div class="col-sm-4 mb-3 align-self-center text-center">
                                    <img src="{{ url("storage/$product->image") }}" class="img-fluid" id="productImage" alt="{{ $product->description }}">
                                </div>
                            </div>
                        <!-- The Modal -->
                        <div id="productImageModal" class="productModal">
                            <span class="close">&times;</span>
                            <img class="productModal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                        @endisset
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mx-1">Salvar</button>
                            <a href="{{ route('produtos.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
