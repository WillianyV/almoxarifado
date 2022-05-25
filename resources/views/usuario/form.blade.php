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
                        @isset($user)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" value="{{ old('name', $user->name ?? '') }}" required>
                                <div id="nameHelp" class="form-text">Obrigatório.</div>
                                @error('name')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" aria-describedby="cpfHelp" value="{{ old('cpf', $user->cpf ?? '') }}" required>
                                <div id="cpfHelp" class="form-text">Obrigatório.</div>
                                @error('cpf')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            @if (!(isset($user)))
                            <div class="col-sm-3 mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" value="{{ old('password', $user->password ?? '') }}" required>
                                <div id="passwordHelp" class="form-text">Obrigatório.</div>
                                @error('password')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="type" class="form-label">Tipo</label>
                                <select class="form-select" name="type" id="type" aria-describedby="typeHelp" required>
                                    <option value="" disabled selected hidden>Selecione o tipo</option>
                                    <option value="USUARIO" {{ old('type', $user->type  ?? '') ==  'USUARIO' ? 'selected' : ''}}>Usuário</option>
                                    <option value="ADMIN" {{ old('type', $user->type  ?? '') ==  'ADMIN' ? 'selected' : ''}}>Admin</option>
                                    <option value="SUPERADIMN" {{ old('type', $user->type  ?? '') ==  'SUPERADIMN' ? 'selected' : ''}}>Super Admin</option>
                                </select>
                                <div id="typeHelp" class="form-text">Obrigatório.</div>
                                @error('type')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" aria-describedby="statusHelp" required>
                                    <option value="" disabled selected hidden>Selecione o status</option>
                                    <option value="Ativo" {{ old('status', $user->status  ?? '') ==  'Ativo' ? 'selected' : ''}}>Ativo</option>
                                    <option value="Desativado" {{ old('status', $user->status  ?? '') ==  'Desativado' ? 'selected' : ''}}>Desativado</option>
                                </select>
                                <div id="statusHelp" class="form-text">Obrigatório.</div>
                                @error('status')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="warehouse_id" class="form-label">Almoxarifado</label>
                                <select class="form-select" name="warehouse_id" id="warehouse_id" aria-describedby="warehouse_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione o almoxarifado</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $user->warehouse_id  ?? '') == $warehouse->id ? 'selected' : ''}}>{{ $warehouse->description }}</option>
                                    @endforeach
                                </select>
                                <div id="warehouse_idHelp" class="form-text">Obrigatório.</div>
                                @error('warehouse_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mx-1">Salvar</button>
                            <a href="{{ route('usuario.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
