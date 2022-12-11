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
    <link href="https://fonts.googleapis.com/css?family=Quicksand rel="stylesheet">

    <!-- Styles -->
    <link href="{{ '/css/app.css' }}" rel="stylesheet">
    <link href="{{ '/css/utility.css' }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-grad-app shadow-sm">
            <div class="container">
                <a href="{{ url('/search') }}">
                    <!--img src="../../../database/img/recipeApp.png" alt="くっくらべる"-->
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-right" href="{{ route('logout') }}"
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
                <div class="card-header lead bg-grad-left text-white px-4">ジャンル一覧</div>
                <div class="card-body py-2 px-4">
                    @include("recipe.genre_search_form")
                </div>
              </div>
            </div>
            <div class="col-md-7 p-0">
                <div class="card h-100">
                    <div class="card-header lead d-flex bg-grad-index text-white">レシピ一覧 </div>
                        <div class="card-body p-1">
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                        @if (session('status'))
                                        <div class="success mt-5 px-4 text-green-900">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        <!-- ページ固有要素 -->
                                        <div class="px-4">
                                            @include("recipe.recipe_search_form")
                                            <div class="py-1"></div>
                                            <table class="table-auto w-full table-striped table-warning border shadow my-6">
                                                <tbody>
                                                @foreach($recipe_list as $recipe)   <!--レシピ一覧を10づつレンダリング-->
                                                <tr class="border">
                                                    <td class="px-3 pt-1">
                                                        <a href='{{ url("/similar/$recipe->recipe_id") }}' class="widelink text-pink">
                                                            <h5 class="font-weight-bold">
                                                                <i class="fas fa-utensils mr-2 text-secondary"></i>{{ $recipe->recipename }}
                                                            </h5>
                                                        </a>
                                                    </td>
                                                    <td class="px-1 py-2">
                                                        <span class="text-left"><i class="fas fa-user-friends mr-1 text-primary"></i>{{ $recipe->num_people }}</span>
                                                        <span class="text-right"><i class="far fa-clock mr-1 lead"></i>{{ $recipe->time }} min</span>
                                                    </td>
                                                    @auth
                                                    <td class="py-2">
                                                        @include("recipe.recipe_tag_form")
                                                    </td>
                                                    @endauth
                                                    <td class="py-2">
                                                        <!--a role="button" class="text-danger btn-lg font-weight-bold disabled" aria-disabled="true">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </a-->
                                                        <a role="button" class="text-danger btn-lg" href="{{ $recipe->url }}" target="_blank">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="py-2 d-flex justify-content-center ">
                                                {{ $recipe_list->appends(request()->input())->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>
                                        <!-- /ページ固有要素 ここまで -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div> <!-- col-md-3 -->
            <div class="col-md-3 p-0">
              @yield('content')
            </div>
          </div> <!-- row justify-content-center -->
        </main>
    </div>
    @yield('footer')
</body>
</html>