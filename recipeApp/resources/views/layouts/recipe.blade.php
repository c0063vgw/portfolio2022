<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CooKらべる') }}</title>

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
        <nav class="navbar navbar-expand-md navbar-light bg-grad-header shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/search') }}">
                    <img src="{{ asset('img/recipeApp.png') }}" alt="くっくらべる" width="280">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item ml-auto">
                                <a class="nav-link text-right" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-right" href="{{ route('register') }}">{{ __('Register') }}</a>
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
              <div class="card-header lead bg-grad-left text-white">ジャンル一覧</div>
              <div class="card-body py-2 px-4">
                @include('recipe.genre_search_form')
                </div>
              </div>
            </div>
            <div class="col-md-5 p-0">
              <div class="card h-100">
                <div class="card-header lead d-flex bg-grad-center text-white">比較元</div>
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
                                    <a href='{{ $recipe->url }}' role="button" class="shadow btn btn-outline-red btn-block text-pink" target="_blank" style="width: auto;">
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
                                        <div class="accordion" id="accordion1">
                                            <div class="card border-danger">
                                                <button type="button" class="btn btn-block card-header text-white bg-orange" data-toggle="collapse" data-target="#process1" aria-expanded="false" aria-controls="process1">
                                                    <span class="display-6"><i class="fas fa-chevron-down mr-1"></i>手順</span>
                                                </button>
                                                <div id="process1" class="collapse" aria-labelledby="headingOne" data-parent="#accordion1">
                                                    <table class="table table-sm">
                                                        <tbody>
                                                            @foreach($processes as $process)
                                                            @foreach($process as $val_1)
                                                            <tr>
                                                                @if($val_1->num != 0)
                                                                <th>{{ $val_1->num }}</th>
                                                                @else
                                                                <th></th>
                                                                @endif
                                                                <td>{{ $val_1->process}}</td>
                                                                @endforeach
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border-danger mt-3">
                                            <div class="card-header display-6 text-white text-center bg-orange">
                                                材料・分量（{{ $recipe->num_people }}人分）
                                            </div>
                                            <table class="table table-sm">
                                                <tbody>
                                                    @foreach($items as $item)
                                                    @foreach($item as $val_2)
                                                    <tr>
                                                        <th>{{ $val_2->ingredient }}</th>
                                                        <td>{{ $val_2->quantity}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endforeach
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