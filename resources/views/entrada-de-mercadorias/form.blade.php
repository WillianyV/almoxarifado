@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4>{{ $title }}</h4>
                    </div>
                    <form action="{{ $action }}" method="post">
                        @csrf
                        @isset($goodsReceipt)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="product_id" class="form-label">Mercadoria</label>
                                <select class="form-select" name="product_id" id="product_id" aria-describedby="product_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione a Mercadoria</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id', $goodsReceipt->product_id  ?? '') == $product->id ? 'selected' : ''}}>{{ $product->description }}</option>
                                    @endforeach
                                </select>
                                <div id="product_idHelp" class="form-text">Obrigatório.</div>
                                @error('product_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="amount" class="form-label">Quantidade</label>
                                <input type="text" class="form-control" name="amount" id="amount" aria-describedby="amountHelp" value="{{ old('amount', $goodsReceipt->amount ?? '') }}" required>
                                <div id="amountHelp" class="form-text">Obrigatório.</div>
                                @error('amount')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="value" class="form-label">Valor</label>
                                <input type="text" class="form-control" name="value" id="value" aria-describedby="valueHelp" value="{{ old('value', $goodsReceipt->value ?? '') }}" required>
                                <div id="valueHelp" class="form-text">Obrigatório.</div>
                                @error('value')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="date" class="form-label">Data</label>
                                <input type="date" class="form-control" name="date" id="date" aria-describedby="dateHelp" value="{{ old('date', $goodsReceipt->dateFormat ?? '') }}" required>
                                <div id="dateHelp" class="form-text">Obrigatório.</div>
                                @error('date')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mx-1">Salvar</button>
                            <a href="{{ route('entrada-de-mercadorias.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
