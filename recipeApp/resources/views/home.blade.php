@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header lead text-indigo bg-pink">Dashboard</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="text-success lead text-center">You are logged in!</div>
            </div>
            <div class="card-footer bg-white">
                <a role="button" class="btn btn-outline-orange btn-lg btn-block shadow" href="{{ url('/search') }}">レシピ一覧へ</a>
            </div>
        </div>
    </div>
</div>
@endsection
