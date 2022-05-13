@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body bg-violet-dark">
                    <div class="mb-3">
                        <h4>{{ $title }}</h4>
                    </div>
                    <form action="{{ $action }}" method="post">
                        @csrf
                        @isset($provider)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" value="{{ old('name', $provider->name ?? '') }}" required>
                                <div id="nameHelp" class="form-text">Obrigatório. Insira o nome do Fornecedor.</div>
                                @error('name')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="cnpj" class="form-label">Descrição</label>
                                <input type="text" class="form-control" name="cnpj" id="cnpj" aria-describedby="cnpjHelp" value="{{ old('cnpj', $provider->cnpj ?? '') }}">
                                <div id="cnpjHelp" class="form-text">Não é obrigatório. Insira o CNPJ do Fornecedor.</div>
                                @error('cnpj')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3  mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" aria-describedby="statusHelp" required>
                                    <option value="" disabled selected hidden>Selecione o status da setor</option>
                                    <option value="Ativo" {{ old('status', $provider->status  ?? '') ==  'Ativo' ? 'selected' : ''}}>Ativo</option>
                                    <option value="Desativado" {{ old('status', $provider->status  ?? '') ==  'Desativado' ? 'selected' : ''}}>Desativado</option>
                                </select>
                                <div id="statusHelp" class="form-text">Obrigatório.</div>
                                @error('status')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mx-1">Salvar</button>
                            <a href="{{ route('fornecedor.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
