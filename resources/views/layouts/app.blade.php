<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ preg_replace('/(?<!^)([a-z])([A-Z])/', '$1 $2', config('app.name', 'Laravel')) }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row m-1">
            {{-- sidebar --}}
            <nav class="col-2 p-1 sticky-top" style="height: fit-content;">
                <h1 class="h4 pt-3 text-center">
                    <a href="{{ url('/')}}" class="text-decoration-none text-secondary"><i class="fa-solid fa-thumbtack"></i></a>
                </h1>
                <div class="list-group text-center text-lg-start mx-2 mb-4">
                    <span class="list-group-item disabled d-none d-lg-block">
                        <small>Master Data</small>
                    </span>
                    <a href="{{ url('/states') }}" class="list-group-item list-grop-item action text-secondary {{ Request::is('states*') ? 'bg-secondary text-light' : 'text-secondary' }}">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span class="d-none d-lg-inline ms-2">States</span>
                    </a>
                    <a href="{{ url('/towns') }}" class="list-group-item list-grop-item action text-secondary {{ Request::is('towns*') ? 'bg-secondary text-light' : 'text-secondary' }}">
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="d-none d-lg-inline ms-2">Towns</span>
                    </a>
                    <a href="{{ url('/roles') }}" class="list-group-item list-grop-item action text-secondary {{ Request::is('roles*') ? 'bg-secondary text-light' : 'text-secondary' }}">
                    <i class="fa-solid fa-user-gear"></i>
                    <span class="d-none d-lg-inline ms-2">Roles</span>
                    </a>
                    <a href="{{ url('/users') }}" class="list-group-item list-grop-item action text-secondary {{ Request::is('users*') ? 'bg-secondary text-light' : 'text-secondary' }}">
                    <i class="fa-solid fa-user"></i>
                    <span class="d-none d-lg-inline ms-2">Users</span>
                    </a>
                </div>
            </nav>

            {{-- main content --}}
            <main class="col-10 bg-light py-4">
                @yield('content')
            </main>

        </div>
    </div>
</body>
@stack('scripts')
</html>
