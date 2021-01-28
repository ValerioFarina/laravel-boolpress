@extends('layouts.dashboard')

@section('page-title', 'Crea nuova categoria')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    Nuova categoria
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="#">
                    @csrf
                    <div class="form-group">
                        <label>Nome categoria: </label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">
                        Salva categoria
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
