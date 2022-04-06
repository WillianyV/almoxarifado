@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4>{{ $company->fantasyName }}</h4>
                    </div>
                    <fieldset disabled>
                        <div class="row">
                            <div class="col-sm-8 mb-3">
                                <label for="fantasyName" class="form-label">Nome Fantasia</label>
                                <input type="text" class="form-control" name="fantasyName" id="fantasyName" value="{{ $company->fantasyName }}">
                            </div>
                            <div class="col-sm-4  mb-3">
                                <label for="corporateName" class="form-label">Razão Social</label>
                                <input type="text" class="form-control" name="corporateName" id="corporateName" value="{{ $company->corporateName }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 mb-3">
                                <label for="cnpj" class="form-label">CNPJ</label>
                                <input type="text" class="form-control" name="cnpj" id="cnpj" value="{{ $company->cnpj }}">
                            </div>
                            <div class="col-sm-4  mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" name="status" id="status" value="{{ $company->status }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="address" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ $company->address->address }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="number" class="form-label">Número</label>
                                <input type="text" class="form-control" name="number" id="number" value="{{ $company->address->number }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="district" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="district" id="district" value="{{ $company->address->district }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="city" class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{ $company->address->city }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="zipcode" class="form-label">CEP</label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode" value="{{ $company->address->zipcode }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="state" class="form-label">Estado</label>
                                <input type="text" class="form-control" name="state" id="state" value="{{ $company->address->state }}">
                            </div>
                        </div>
                    </fieldset>
                    <div class="text-end">
                        <a href="{{ route('empresa.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
