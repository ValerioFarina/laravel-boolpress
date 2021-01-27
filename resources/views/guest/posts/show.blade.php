@extends('layouts.app')

@section('page-title', 'Dettagli post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul>
                    <li>
                        <strong>Autore:</strong>
                        {{ $post->author }}
                    </li>
                    <li>
                        <strong>Categoria:</strong>
                        {{ $post->category ? $post->category->name : '' }}
                    </li>
                    <li>
                        <strong>Contenuto:</strong>
                        {{ $post->content }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
