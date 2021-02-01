@extends('layouts.dashboard')

@section('page-title', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>Nome:</strong>
                            {{ Auth::user()->name }}
                        </li>
                        <li class="mb-2">
                            <strong>Email:</strong>
                            {{ Auth::user()->email }}
                        </li>
                        <li>
                            @if (Auth::user()->api_token)
                                <strong>API token:</strong>
                                {{ Auth::user()->api_token }}
                            @else
                                <button class="btn btn-success">Genera API token</button>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
