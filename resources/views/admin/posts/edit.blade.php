@extends('layouts.dashboard')

@section('page-title', 'Modifica post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    Modifica post
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('admin.posts.update', ['post' => $post->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Titolo: </label>
                        <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                    </div>
                    <div class="form-group">
                        <label>Autore: </label>
                        <input type="text" name="author" class="form-control" value="{{ $post->author }}">
                    </div>
                    <div class="form-group">
                        <label>Categoria: </label>
                        <select class="form-control" name="category_id">
                            <option value="">--- seleziona categoria ---</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category && $post->category->id == $category->id ? "selected" : "" }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contenuto: </label>
                        <textarea name="content" rows="8" cols="80" class="form-control">{{ $post->content }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Salva modifiche
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
