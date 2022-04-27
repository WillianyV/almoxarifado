<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- The page supports both dark and light color schemes,
         and the page author prefers / default is light. -->
    <meta name="color-scheme" content="light dark">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Replace the Bootstrap CSS with the Bootstrap-Dark Variant CSS -->
    <link href="{{ asset('css/bootstrap-nightshade.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style-image-modal.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- <img src="{{ asset('img/logo-grupo-compare.png') }}" alt="APP Registros" height="27">
                    &nbsp; --}}
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ">
                                {{-- {{ Route::is('lancamento-filial.index','lancamento-filial.create','lancamento-filial.show','lancamento-filial.edit')? 'active': '' }} --}}
                                <a class="nav-link " href="{{ route('funcao.index') }}">
                                    Função
                                </a>
                            </li>
                            {{-- Perfil --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    {{-- <a class="dropdown-item" href="{{ route('perfil.index') }}">
                                        Perfil
                                    </a> --}}

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        {{-- <li class="nav-item align-self-center">
                            &nbsp;

                            &nbsp;
                        </li> --}}
                        {{-- <li class="nav-item align-self-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="your-darkmode-button-id">
                                <label class="form-check-label" for="your-darkmode-button-id">
                                    <img src="{{ asset('img/moon.png') }}">
                                </label>
                            </div>
                        </li> --}}
                        <li class="nav-item align-self-center">
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="your-darkmode-button-id">
                                <span class="align-top">
                                    <img src="{{ asset('img/sun.png') }}">
                                    &nbsp;
                                    <img src="{{ asset('img/moon.png') }}">
                                </span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            {{-- Alertas --}}
            {{-- <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        @include('components.alerts')
                    </div>
                </div>
            </div> --}}
            {{-- Conteúdo --}}
            @yield('content')
            {{-- Rodapé --}}
        </main>
    </div>

    <!-- Optional Bootstrap JavaScript -->
    <script src="location/of/the/bootstrap.js/here"></script>

    <!-- Required DarkMode JavaScript -->
    <script src="{{ asset('js/darkmode.min.js') }}"></script>
    <script>
        document.querySelector("#your-darkmode-button-id").onclick = function(e) {
            darkmode.toggleDarkMode();
        }
    </script>
    <script src="{{ asset('js/imageProductModal.js') }}"></script>
</body>

</html>
