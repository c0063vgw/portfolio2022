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
                    <div class="text-success my-1">You are logged in!</div>
                    <div class="my-1">
                        <button type="button" class="btn btn-outline-success btn-sm font-weight-bold">
                            <i class="fas fa-hashtag"></i>タグ
                        </button>
                        でタグを登録できます。
                    </div>
                @endauth
                @guest
                <div>タグ付けされたレシピを比較できます。</div>
                <div class="my-1">
                    <a role="button" class="btn btn-outline-danger btn-sm font-weight-bold">
                        <i class="far fa-clone mr-1"></i>比較
                    </a>
                    でレシピを比較できます。
                </div>
                <div>
                    ログインでタグ登録機能がご利用いただけます。
                </div>
                @endguest
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
