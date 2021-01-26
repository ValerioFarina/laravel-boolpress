@extends('layouts.dashboard')

@section('page-title', 'Posts')

@section('content')
    <div class="container">
        @if (count($posts))
            <div class="row">
                <div class="col-12">
                    <h1>Lista posts</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="albums-list">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Titolo</th>
                                    <th scope="col">Autore</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->author }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info">
                                                Dettagli
                                            </a>
                                            <a href="#" class="btn btn-warning">
                                                Modifica
                                            </a>
                                            <a href="#" class="btn btn-danger">
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
        @else
            <div class="row">
                <div class="col-12">
                    <h1 class="mt-5">Nessun post presente</h1>
                </div>
            </div>
        @endif
    </div>
@endsection
