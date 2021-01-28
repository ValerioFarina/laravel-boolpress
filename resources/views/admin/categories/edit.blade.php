@extends('layouts.dashboard')

@section('page-title', 'Modifica categoria')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    Modifica categoria
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nome categoria: </label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                    </div>
                    <button type="submit" class="btn btn-success">
                        Salva modifiche
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
