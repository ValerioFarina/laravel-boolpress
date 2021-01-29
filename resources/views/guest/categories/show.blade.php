@extends('layouts.app')

@section('page-title', 'Post con categoria ' . $category->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    {{ count($category->posts) ? "Lista post nella categoria '" . $category->name . "'" : "Nessun post nella categoria '" . $category->name . "'" }}
                </h1>
            </div>
        </div>
        @if (count($category->posts))
            <div class="row">
                @foreach ($category->posts as $post)
                    <div class="col-12 col-xs-6 col-md-4 col-lg-3 mb-3">
                        <a class="post border p-3 h-100 d-block" href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                            <ul class="h-100">
                                <li>
                                    Titolo:
                                    {{ $post->title }}
                                </li>
                                <li>
                                    Autore:
                                    {{ $post->author }}
                                </li>
                            </ul>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
