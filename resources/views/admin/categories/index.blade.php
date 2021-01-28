@extends('layouts.dashboard')

@section('page-title', 'Categories')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="categories-list-title">
                    {{ count($categories) ? 'Lista categorie' : 'Nessuna categoria presente' }}
                </h1>
            </div>
            <div class="col-6 text-right">
                <a href="#" class="btn btn-primary">
                    Crea nuova categoria
                </a>
            </div>
        </div>
        @if (count($categories))
            <div class="row categories-list">
                <div class="col-12">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome categoria</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr id="{{ $category->id }}">
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info">
                                                Dettagli
                                            </a>
                                            <a href="#" class="btn btn-warning">
                                                Modifica
                                            </a>
                                            <a href="#" class="btn btn-danger delete-category">
                                                Elimina
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
