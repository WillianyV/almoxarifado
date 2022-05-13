@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-violet-dark">
                <div class="card-body">
                    <div class="mb-3">
                        <h4>{{ $employee->name }}</h4>
                    </div>
                    <fieldset disabled>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="code" class="form-label">Código</label>
                                <input type="text" class="form-control" name="code" value="{{ $employee->code }}">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" name="cpf" value="{{ $employee->cpf }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 mb-3">
                                <label for="role_id" class="form-label">Função</label>
                                <input type="text" class="form-control" name="role_id" value="{{ $employee->role->description }}">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="department_id" class="form-label">Setor</label>
                                <input type="text" class="form-control" name="role_id" value="{{ $employee->department->description }}">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="company_id" class="form-label">Empresa</label>
                                <input type="text" class="form-control" name="company_id" value="{{ $employee->company->description }}">
                            </div>
                            <div class="col-sm-3 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" name="status" value="{{ $employee->status}}">
                            </div>
                        </div>
                    </fieldset>
                    <div class="text-end">
                        <a href="{{ route('funcionario.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
