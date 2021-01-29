@extends('layouts.app')

@section('page-title', 'Categorie')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-2 mb-4">
                <h1>
                    {{ count($categories) ? 'Lista categorie' : 'Nessuna categoria presente' }}
                </h1>
            </div>
        </div>
        @if (count($categories))
            <div class="row">
                <div class="col-12">
                    <div class="categories-list">
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('categories.show', ['slug' => $category->slug]) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
