@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4>#{{ $warehouse->id }} - {{ $warehouse->description }}</h4>
                    </div>
                    <fieldset disabled>
                        <div class="row">
                            <div class="col-sm-8 mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <input type="text" class="form-control" name="description" value="{{ $warehouse->description }}">
                            </div>
                            <div class="col-sm-4  mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" name="status" value="{{ $warehouse->status }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="address" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" name="address" value="{{ $warehouse->address->address }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="number" class="form-label">Número</label>
                                <input type="text" class="form-control" name="number" value="{{ $warehouse->address->number }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="district" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="district" value="{{ $warehouse->address->district }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="city" class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="city" value="{{ $warehouse->address->city}}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="zip_code" class="form-label">CEP</label>
                                <input type="text" class="form-control" name="zip_code" value="{{ $warehouse->address->zip_code }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="state" class="form-label">Estado</label>
                                <input type="text" class="form-control" name="state" value="{{ $warehouse->address->state }}">
                            </div>
                        </div>
                    </fieldset>
                    <div class="text-end">
                        <a href="{{ route('almoxarifado.index') }}" type="button" class="btn btn-danger">Cancelar</a>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection