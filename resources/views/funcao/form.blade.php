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
                        @isset($role)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-sm-8 mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <input type="text" class="form-control" name="description" id="description" aria-describedby="descriptionHelp" value="{{ $role->description ?? '' }}" required>
                                <div id="descriptionHelp" class="form-text">Obrigatório. Insira uma função do funcionário.</div>
                            </div>
                            <div class="col-sm-4  mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" aria-describedby="statusHelp" required>
                                    <option value="" disabled selected hidden>Selecione o status da Função</option>
                                    <option value="{{ 1 }}" {{ ($role->status  ?? '') ==  'Ativo' ? 'selected' : ''}}>Ativo</option>
                                    <option value="{{ 0 }}" {{ ($role->status  ?? '') ==  'Desativado' ? 'selected' : ''}}>Desativado</option>
                                </select>
                                <div id="statusHelp" class="form-text">Obrigatório.</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mx-1">Salvar</button>
                            <a href="{{ route('funcao.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                        </div>                                        
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection