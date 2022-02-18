@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row mb-3">
                    <div class="col">
                        <h4>Setores</h4>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('setor.create') }}" type="button" class="btn btn-primary">Adicionar</a>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('setor.pdf', $filters['search'] ?? '') }}" type="button" class="btn btn-danger">PDF</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <form action="{{ route('setor.index') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control" placeholder="Pesquisar Função" value="{{ $filters['search'] ?? '' }}">
                                    <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <th scope="row">{{ $department->id }}</th>
                                        <td>{{ $department->description }}</td>
                                        <td>{{ $department->status }}</td>
                                        <td>
                                            <a href="{{ route('setor.edit', $department->id) }}" type="button"
                                                class="btn btn-primary btn-sm mb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('setor.destroy',['setor' => $department->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit">deletar</button>
                                            </form>
                                            {{-- <a href="#" type="button" class="btn btn-danger btn-sm mb-1" title="Deletar"
                                                data-bs-toggle="modal" data-bs-target="#modalDelete{{ $department->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </a> --}}
                                        </td>
                                        {{-- @include('setor.modal.delete') --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        @if (isset($filters))
                            {{ $departments->appends($filters)->links() }}
                        @else
                            {{ $departments->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
