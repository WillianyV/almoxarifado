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
                        @isset($employee)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" value="{{ old('name', $employee->name ?? '') }}" required>
                                <div id="nameHelp" class="form-text">Obrigatório.</div>
                                @error('name')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="code" class="form-label">Código</label>
                                <input type="text" class="form-control" name="code" id="code" aria-describedby="codeHelp" value="{{ old('code', $employee->code ?? '') }}" required>
                                <div id="codeHelp" class="form-text">Obrigatório.</div>
                                @error('code')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" aria-describedby="cpfHelp" value="{{ old('cpf', $employee->cpf ?? '') }}" required>
                                <div id="cpfHelp" class="form-text">Obrigatório.</div>
                                @error('cpf')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 mb-3">
                                <label for="role_id" class="form-label">Função</label>
                                <select class="form-select" name="role_id" id="role_id" aria-describedby="role_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione a função</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id', $employee->role_id  ?? '') == $role->id ? 'selected' : ''}}>{{ $role->description }}</option>
                                    @endforeach
                                </select>
                                <div id="role_idHelp" class="form-text">Obrigatório.</div>
                                @error('role_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="department_id" class="form-label">Setor</label>
                                <select class="form-select" name="department_id" id="department_id" aria-describedby="department_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione o setor</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id  ?? '') == $department->id ? 'selected' : ''}}>{{ $department->description }}</option>
                                    @endforeach
                                </select>
                                <div id="department_idHelp" class="form-text">Obrigatório.</div>
                                @error('department_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="company_id" class="form-label">Empresa</label>
                                <select class="form-select" name="company_id" id="company_id" aria-describedby="company_idHelp" required>
                                    <option value="" disabled selected hidden>Selecione o setor</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id', $employee->company_id  ?? '') == $company->id ? 'selected' : ''}}>{{ $company->description }}</option>
                                    @endforeach
                                </select>
                                <div id="company_idHelp" class="form-text">Obrigatório.</div>
                                @error('company_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" aria-describedby="statusHelp" required>
                                    <option value="" disabled selected hidden>Selecione o status da setor</option>
                                    <option value="Ativo" {{ old('status', $employee->status  ?? '') ==  'Ativo' ? 'selected' : ''}}>Ativo</option>
                                    <option value="Desativado" {{ old('status', $employee->status  ?? '') ==  'Desativado' ? 'selected' : ''}}>Desativado</option>
                                </select>
                                <div id="statusHelp" class="form-text">Obrigatório.</div>
                                @error('status')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mx-1">Salvar</button>
                            <a href="{{ route('funcionario.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
