<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'recipeApp') }}</title>

    <!-- Scripts -->
    <script src="{{ '/js/app.js' }}" defer></script>
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ '/css/app.css' }}" rel="stylesheet">
    <link href="{{ '/css/utility.css' }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/search') }}">
                    {{ config('app.name', 'recipeApp') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item ml-auto">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown ml-auto">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
        @endif
          <div class="row" style='height: 92vh;'>
            <div class="col-md-2 p-0">
              <div class="card h-100">
              <div class="card-header bg-pink">タグ一覧</div>
              <div class="card-body py-2 px-4">
                <a class='d-block' href='/'>全て表示</a>
                </div>
              </div>
            </div>
            <div class="col-md-5 p-0">
              <div class="card h-100">
                <div class="card-header d-flex bg-pink">比較元 </div>
                <div class="card-body py-4">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                @if (session('status'))
                                <div class="success mt-5 px-4 text-green-900">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <!-- ページ固有要素 -->
                                <div>
                                    <a href='{{ $recipe->url }}' role="button" class="btn btn-outline-red btn-block text-pink" target="_blank" style="width: auto;">
                                        <h5 class="font-weight-bold pt-1">
                                            <i class="fas fa-utensils mr-2 text-secondary"></i>{{ $recipe->recipename }}
                                        </h5>
                                    </a>
                                    <div class="card-columns">
                                        <div class="card border-white mt-3">
                                            <table class="table">
                                                <thead class="text-white">
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">調理時間</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $recipe->time }} min</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">エネルギー</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $recipe->energy }} kal</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">食塩相当量</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $recipe->salt }} g</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="card border-danger">
                                            <div class="card-header display-6 text-white bg-orange">
                                                手順
                                            </div>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                            </tr>
                                        </div>
                                        <div class="card border-danger mt-3">
                                            <div class="card-header display-6 text-white bg-orange">
                                                材料・分量
                                            </div>
                                            <table class="table table-sm">
                                                <tbody>
                                                    @foreach($items as $item)
                                                    @foreach($item as $val)
                                                    <tr>
                                                        
                                                        <th>{{ $val->ingredient }}</th>
                                                        <td>{{ $val->quantity}}</td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /ページ固有要素 ここまで -->
                            </div>
                        </div>
                    </div>
                </div>
              </div>    
            </div> <!-- col-md-3 -->
            <div class="col-md-5 p-0">
              @yield('content')
            </div>
          </div> <!-- row justify-content-center -->
        </main>
    </div>
    @yield('footer')
</body>
</html>