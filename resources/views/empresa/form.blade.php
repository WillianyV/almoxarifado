@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-violet-dark">
                <div class="card-body">
                    <div class="mb-3">
                        <h4>{{ $title }}</h4>
                    </div>
                    <form action="{{ $action }}" method="post">
                        @csrf
                        @isset($company)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="fantasyName" class="form-label">Nome Fantasia</label>
                                <input type="text" class="form-control" name="fantasyName" id="fantasyName" aria-describedby="fantasyNameHelp" value="{{ old('fantasyName', $company->fantasyName ?? '') }}" required>
                                <div id="fantasyNameHelp" class="form-text">Obrigatório.</div>
                                @error('fantasyName')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-6  mb-3">
                                <label for="corporateName" class="form-label">Razão Social</label>
                                <input type="text" class="form-control" name="corporateName" id="corporateName" aria-describedby="corporateNameHelp" value="{{ old('corporateName', $company->corporateName ?? '') }}" required>
                                <div id="corporateNameHelp" class="form-text">Obrigatório.</div>
                                @error('corporateName')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="cnpj" class="form-label">CNPJ</label>
                                <input type="text" class="form-control" name="cnpj" id="cnpj" aria-describedby="cnpjHelp" value="{{ old('cnpj', $company->cnpj ?? '') }}" required>
                                <div id="cnpjHelp" class="form-text">Obrigatório.</div>
                                @error('cnpj')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-4  mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" aria-describedby="statusHelp" required>
                                    <option value="" disabled selected hidden>Selecione o status da setor</option>
                                    <option value="Ativo" {{ old('status', $company->status  ?? '') ==  'Ativo' ? 'selected' : ''}}>Ativo</option>
                                    <option value="Desativado" {{ old('status', $company->status  ?? '') ==  'Desativado' ? 'selected' : ''}}>Desativado</option>
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
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $company->warehouse_id  ?? '') == $warehouse->id ? 'selected' : ''}}>{{ $warehouse->description }}</option>
                                    @endforeach
                                </select>
                                <div id="warehouse_idHelp" class="form-text">Obrigatório.</div>
                                @error('warehouse_id')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="address" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" name="address" id="address" aria-describedby="addressHelp" value="{{ old('address', $company->address->address ?? '') }}" required>
                                <div id="addressHelp" class="form-text">Obrigatório.</div>
                                @error('address')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-2 mb-3">
                                <label for="number" class="form-label">Número</label>
                                <input type="text" class="form-control" name="number" id="number" aria-describedby="numberHelp" value="{{ old('number', $company->address->number ?? '') }}" required>
                                <div id="numberHelp" class="form-text">Obrigatório.</div>
                                @error('number')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="district" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="district" id="district" aria-describedby="districtHelp" value="{{ old('district', $company->address->district ?? '') }}" required>
                                <div id="districtHelp" class="form-text">Obrigatório.</div>
                                @error('district')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="city" class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="city" id="city" aria-describedby="cityHelp" value="{{ old('city', $company->address->city ?? '') }}" required>
                                <div id="cityHelp" class="form-text">Obrigatório.</div>
                                @error('city')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="zipcode" class="form-label">CEP</label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode" aria-describedby="zipcodeHelp" value="{{ old('zipcode', $company->address->zipcode ?? '') }}" required>
                                <div id="zipcodeHelp" class="form-text">Obrigatório.</div>
                                @error('zipcode')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="state" class="form-label">Estado</label>
                                <select class="form-select" name="state" id="state" aria-describedby="stateHelp" required>
                                    <option value="" disabled selected hidden>Selecione o estado da setor</option>
                                    <option value="PE" {{ old('state', $company->address->state  ?? '') ==  'PE' ? 'selected' : ''}}>Pernambuco</option>
                                    <option value="ES" {{ old('state', $company->address->state  ?? '') ==  'ES' ? 'selected' : ''}}>Estrangeiro</option>
                                </select>
                                <div id="stateHelp" class="form-text">Obrigatório.</div>
                                @error('state')
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success mx-1">Salvar</button>
                            <a href="{{ route('empresa.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
