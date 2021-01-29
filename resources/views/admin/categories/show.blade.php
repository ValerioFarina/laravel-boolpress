@extends('layouts.dashboard')

@section('page-title', 'Post categoria ' . $category->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 data-category-name="{{ $category->name }}" class="list-title">
                    {{ count($category->posts) ? "Lista post nella categoria '" . $category->name . "'" : "Nessun post presente nella categoria '" . $category->name . "'" }}
                </h1>
            </div>
        </div>
        @if (count($category->posts))
            <div class="row posts-list">
                <div class="col-12">
                    <div>
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
                                @foreach ($category->posts as $post)
                                    <tr id="{{ $post->id }}" data-item-type="post-category">
                                        <th scope="row">{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->author }}</td>
                                        <td>
                                            <a href="{{ route('admin.posts.show', ['post' => $post->slug]) }}" class="btn btn-info">
                                                Dettagli
                                            </a>
                                            <a href="{{ route('admin.posts.edit', ['post' => $post->slug]) }}" class="btn btn-warning">
                                                Modifica
                                            </a>
                                            <a href="#" class="btn btn-danger delete-item">
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
