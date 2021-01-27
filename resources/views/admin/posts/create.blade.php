@extends('layouts.dashboard')

@section('page-title', 'Crea nuovo post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    Nuovo post
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('admin.posts.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Titolo: </label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Autore: </label>
                        <input type="text" name="author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Categoria: </label>
                        <select class="form-control" name="category_id">
                            <option value="">--- seleziona categoria ---</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contenuto: </label>
                        <textarea name="content" rows="8" cols="80" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Salva post
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
