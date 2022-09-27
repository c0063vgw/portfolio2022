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
                <h5 class="text-success">タグを追加しました！</h5>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a role="button" class="btn btn-outline-orange" href="{{ $url }}">戻る</a>
                <a role="button" class="btn btn-outline-orange" href="{{ url("/compare/$recipe_id") }}">タグを編集</a>
            </div>
        </div>
    </div>
</div>
@endsection
