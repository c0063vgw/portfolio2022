@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
        <div class="card">
            <div class="card-header lead text-indigo bg-pink">Tips</div>
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
                        からレシピタグを登録できます。
                    </div>
                @endauth
                @guest
                <div>
                    レシピ比較サイト「<span class="text-danger">CooKらべる</span>」へようこそ！
                </div>
                <div>
                    あなたにぴったりのレシピを探しにいきましょう。
                </div>
                <div class="my-1">
                    <a role="button" class="text-danger btn-sm">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    から引用元のページへ移ります。
                </div>
                <div>
                    ログインで
                    <button type="button" class="btn btn-outline-success btn-sm font-weight-bold">
                        <i class="fas fa-hashtag"></i>タグ
                    </button>
                    登録機能がご利用いただけます。
                </div>
                @endguest
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
