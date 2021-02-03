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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="create-update-post" method="POST" action="{{ route('admin.posts.update', ['post' => $post->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Titolo: </label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" maxlength="255" required>
                        @error ('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Autore: </label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $post->author) }}" maxlength="50" required>
                        @error ('author')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Categoria: </label>
                        <select class="form-control" name="category_id">
                            <option value="">--- seleziona categoria ---</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? "selected" : "" }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error ('category_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tag: </label>
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                @if ($errors->any())
                                    <input name="tags[{{ $tag->id }}]" class="form-check-input" type="checkbox" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                @else
                                    <input name="tags[{{ $tag->id }}]" class="form-check-input" type="checkbox" value="{{ $tag->id }}" {{ $post->tags->contains($tag) ? "checked" : "" }}>
                                @endif
                                <label class="form-check-label">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                        @error ('tags')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Contenuto: </label>
                        <textarea name="content" rows="8" cols="80" class="form-control" required>{{ old('content', $post->content) }}</textarea>
                        @error ('content')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        Salva modifiche
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
