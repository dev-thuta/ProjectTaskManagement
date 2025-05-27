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
            <aside class="col-2 p-0 bg-white border-end min-vh-100 d-flex flex-column align-items-stretch sticky-top shadow-sm" style="height: 100vh;">
                <div class="py-3 text-center border-bottom">
                    <a href="{{ url('/') }}" class="text-decoration-none text-dark fs-4">
                        <i class="fa-solid fa-home"></i>
                        <span class="d-none d-lg-inline ms-2">Home</span>
                    </a>
                </div>
                <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <div>
                        <div class="list-group list-group-flush text-center text-lg-start mb-3">
                            <span class="list-group-item disabled d-none d-lg-block bg-white border-0">
                                <small class="text-muted">Master Data</small>
                            </span>
                            <a href="{{ url('/states') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('states*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <span class="d-none d-lg-inline ms-2">States</span>
                            </a>
                            <a href="{{ url('/towns') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('towns*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="d-none d-lg-inline ms-2">Towns</span>
                            </a>
                            <a href="{{ url('/roles') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('roles*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-user-gear"></i>
                                <span class="d-none d-lg-inline ms-2">Roles</span>
                            </a>
                        </div>
                        <div class="list-group list-group-flush text-center text-lg-start mb-3">
                            <span class="list-group-item disabled d-none d-lg-block bg-white border-0">
                                <small class="text-muted">Transactions</small>
                            </span>
                            <a href="{{ url('/users') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('users*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-user-check"></i>
                                <span class="d-none d-lg-inline ms-2">Users</span>
                            </a>
                            <a href="{{ url('/clients') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('clients*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-handshake"></i>
                                <span class="d-none d-lg-inline ms-2">Clients</span>
                            </a>
                            <a href="{{ url('/projects') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('projects*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-diagram-project"></i>
                                <span class="d-none d-lg-inline ms-2">Projects</span>
                            </a>
                            <a href="{{ url('/teams') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('teams*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-users-gear"></i>
                                <span class="d-none d-lg-inline ms-2">Teams</span>
                            </a>
                            <a href="{{ url('/team-members') }}" class="list-group-item list-group-item-action border-0 rounded-0 {{ Request::is('team-members*') ? 'active bg-secondary text-light' : 'text-secondary' }}">
                                <i class="fa-solid fa-users"></i>
                                <span class="d-none d-lg-inline ms-2">Team Members</span>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- main content --}}
            <main class="col-10 bg-light py-4">
                @yield('content')
            </main>

        </div>
    </div>
</body>
@stack('scripts')
</html>
