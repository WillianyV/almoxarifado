<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-image-modal.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
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

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            {{-- Lancamento --}}
                            {{-- <li class="nav-item ">
                                <a class="nav-link {{ Route::is('lancamento-filial.index','lancamento-filial.create','lancamento-filial.show','lancamento-filial.edit')? 'active': '' }}"
                                    href="{{ route('lancamento-filial.index') }}">
                                    Lançamento Filial
                                </a>
                            </li> --}}

                            {{-- MOVIMENTO DIARIO --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Movimento Diario</a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('entrada-de-mercadorias.index') }}">Entrada de Mercadorias</a>
                                    <a class="dropdown-item" href="{{ route('categoria.index') }}">Saída de Mercadorias</a>
                                    {{-- <div class="dropdown-divider"></div> --}}
                                </div>
                            </li>
                            {{-- EVENTUAIS --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle
                                {{ Route::is('almoxarifado.index','almoxarifado.create','almoxarifado.show','almoxarifado.edit',
                                'categoria.index','categoria.create','categoria.edit',
                                'empresa.index','empresa.create','empresa.show','empresa.edit',
                                'fornecedor.index','fornecedor.create','fornecedor.edit',
                                'funcao.index','funcao.create','funcao.edit',
                                'funcionario.index','funcionario.create','funcionario.show','funcionario.edit',
                                'produtos.index','produtos.create','produtos.show','produtos.edit',
                                'setor.index','setor.create','setor.edit',
                                'usuario.index','usuario.create','usuario.show','usuario.edit',)? 'active': '' }}
                                " href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Eventuais</a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('almoxarifado.index') }}">Almoxarifados</a>
                                    <a class="dropdown-item" href="{{ route('categoria.index') }}">Categorias</a>
                                    <a class="dropdown-item" href="{{ route('empresa.index') }}">Empresas</a>
                                    <a class="dropdown-item" href="{{ route('fornecedor.index') }}">Fornecedores</a>
                                    <a class="dropdown-item" href="{{ route('funcao.index') }}">Funções</a>
                                    <a class="dropdown-item" href="{{ route('funcionario.index') }}">Funcionários</a>
                                    <a class="dropdown-item" href="{{ route('produtos.index') }}">Produtos</a>
                                    <a class="dropdown-item" href="{{ route('setor.index') }}">Setores</a>
                                    <a class="dropdown-item" href="{{ route('usuario.index') }}">Usuarios</a>
                                </div>
                            </li>

                            {{-- Perfil --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('usuario.index') }}">Perfil</a>
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
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/imageProductModal.js') }}"></script>
</body>

</html>
