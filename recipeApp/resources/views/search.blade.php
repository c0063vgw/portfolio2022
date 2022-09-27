@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
        <div class="card">
            <div class="card-header lead text-indigo bg-pink">Dashboard</div>
            <div class="card-body text-info">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @auth
                    You are logged in!
                @endauth
                @guest
                    ログインでタグ登録機能がご利用いただけます。
                @endguest
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
