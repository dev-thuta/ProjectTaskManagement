<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Vite --}}

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background: linear-gradient(120deg, var(--primary-color), #a084cf);
            min-height: 100vh;
            color: white;
            font-family: var(--font-family-sans-serif);
        }

        /* Navbar Customization */
        #app .navbar {
            background-color: rgba(0, 0, 0, 0.15) !important;
            box-shadow: none !important;
        }

        #app .navbar .navbar-brand,
        #app .navbar .nav-link,
        #app .navbar .dropdown-toggle {
            color: var(--table-header-text) !important;
        }

        #app .navbar .nav-link:hover,
        #app .navbar .navbar-brand:hover,
        #app .navbar .dropdown-toggle:hover {
            color: #e0e0e0 !important;
        }

        #app .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5) !important;
        }

        #app .navbar-toggler-icon {
            filter: invert(1) brightness(1.5);
        }

        #app .dropdown-menu {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border-color);
        }

        #app .dropdown-menu .dropdown-item {
            color: var(--text-color) !important;
        }

        #app .dropdown-menu .dropdown-item:hover {
            background-color: #f5f5f5;
            color: #222222 !important;
        }

        #app .dropdown-menu .dropdown-item form button.btn-link {
            color: var(--text-color) !important;
            text-decoration: none;
        }

        #app .dropdown-menu .dropdown-item form button.btn-link:hover {
            color: #222222 !important;
        }

        /* Sidebar Customization */
        .custom-sidebar {
            background-color: rgba(0, 0, 0, 0.1) !important;
            box-shadow: none !important;
            height: 100vh;
        }

        .custom-sidebar .sidebar-home-link-container {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .custom-sidebar .sidebar-home-link {
            color: var(--table-header-text) !important;
            opacity: 0.9;
        }

        .custom-sidebar .sidebar-home-link:hover {
            opacity: 1;
        }

        .custom-sidebar .list-group-item {
            background-color: transparent !important;
            color: #e0e0e0 !important;
            border: none !important;
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
        }

        .custom-sidebar .list-group-item:hover,
        .custom-sidebar .list-group-item:focus {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: white !important;
        }

        .custom-sidebar .list-group-item.active {
            background-color: var(--card-bg) !important;
            color: var(--primary-color) !important;
            font-weight: bold;
        }

        .custom-sidebar .list-group-item.active i {
            color: var(--primary-color) !important;
        }

        .custom-sidebar .list-group-item i {
            color: inherit;
            width: 20px;
            margin-right: 2px;
        }

        .custom-sidebar .list-group-item.disabled {
            opacity: 1;
        }

        .custom-sidebar .list-group-item.disabled small {
            color: #c0c0c0 !important;
            font-weight: 500;
        }

        /* Main Content Area */
        .main-content-area {
            background-color: transparent !important;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .main-content-area .card {
            background-color: var(--card-bg);
            color: var(--text-color);
            border: none;
        }

        .main-content-area .card-header {
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }

        /* Fix container paddings */
        .container-fluid,
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .layout-row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .layout-row > [class*="col-"] {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .main-content-area > .container,
        .main-content-area > .container-fluid {
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ preg_replace('/(?<!^)([a-z])([A-Z])/', '$1 $2', config('app.name', 'Laravel')) }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        {{-- You can add links here if needed --}}
                    </ul>

                    <ul class="navbar-nav ms-auto">
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

        <div class="row layout-row">
            {{-- sidebar --}}
            <aside class="col-2 p-0 custom-sidebar d-flex flex-column align-items-stretch">
                <div class="py-3 text-center sidebar-home-link-container">
                    <a href="{{ url('/home') }}" class="text-decoration-none fs-4 sidebar-home-link">
                        <i class="fa-solid fa-house"></i> <!-- Changed fa-home to fa-house (more modern) -->
                    </a>
                </div>
                <div class="flex-grow-1 d-flex flex-column justify-content-between">
                    <div>
                        <div class="list-group list-group-flush text-center text-lg-start mb-3">
                            <span class="list-group-item disabled d-none d-lg-block border-0">
                                <small class="text-muted">Master Data</small>
                            </span>
                            <a href="{{ url('/states') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('states*') ? 'active' : '' }}">
                                <i class="fa-solid fa-globe-americas"></i> <!-- More global/geographical icon -->
                                <span class="d-none d-lg-inline ms-2">States / Regions</span>
                            </a>
                            <a href="{{ url('/towns') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('towns*') ? 'active' : '' }}">
                                <i class="fa-solid fa-city"></i> <!-- City icon for townships -->
                                <span class="d-none d-lg-inline ms-2">Townships</span>
                            </a>
                            <a href="{{ url('/roles') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('roles*') ? 'active' : '' }}">
                                <i class="fa-solid fa-id-badge"></i> <!-- Role/User badge icon -->
                                <span class="d-none d-lg-inline ms-2">Roles</span>
                            </a>
                        </div>
                        <div class="list-group list-group-flush text-center text-lg-start mb-3">
                            <span class="list-group-item disabled d-none d-lg-block border-0">
                                <small class="text-muted">Transactions</small>
                            </span>
                            <a href="{{ url('/users') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('users*') ? 'active' : '' }}">
                                <i class="fa-solid fa-user"></i> <!-- Simple user icon -->
                                <span class="d-none d-lg-inline ms-2">Users</span>
                            </a>
                            <a href="{{ url('/clients') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('clients*') ? 'active' : '' }}">
                                <i class="fa-solid fa-handshake-angle"></i> <!-- More handshake styled icon -->
                                <span class="d-none d-lg-inline ms-2">Clients</span>
                            </a>
                            <a href="{{ url('/projects') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('projects*') ? 'active' : '' }}">
                                <i class="fa-solid fa-diagram-project"></i> <!-- Keep same for projects -->
                                <span class="d-none d-lg-inline ms-2">Projects</span>
                            </a>
                            <a href="{{ url('/teams') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('teams*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-cog"></i> <!-- More group/team icon -->
                                <span class="d-none d-lg-inline ms-2">Teams</span>
                            </a>
                            <a href="{{ url('/team-members') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('team-members*') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-group"></i> <!-- User group icon for team members -->
                                <span class="d-none d-lg-inline ms-2">Team Members</span>
                            </a>
                            <a href="{{ url('/tasks') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('tasks*') ? 'active' : '' }}">
                                <i class="fa-solid fa-check-to-slot"></i> <!-- Modern task/check icon -->
                                <span class="d-none d-lg-inline ms-2">Tasks</span>
                            </a>
                            <a href="{{ url('/assigns') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('assigns*') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-plus"></i> <!-- Assign/add user icon -->
                                <span class="d-none d-lg-inline ms-2">Assigned Members</span>
                            </a>
                            <a href="{{ url('/messages') }}" class="list-group-item list-group-item-action rounded-0 {{ Request::is('messages*') ? 'active' : '' }}">
                                <i class="fa-solid fa-message"></i> <!-- Assign/add user icon -->
                                <span class="d-none d-lg-inline ms-2">Messages</span>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- main content --}}
            <main class="col-10 main-content-area">
                {{-- Content rendered here needs its own background if it's not text directly on the gradient --}}
                {{-- For example, wrap your @yield('content') in a container or card structure if needed --}}
                {{-- <div class="container py-4"> OR <div class="container-fluid py-4"> --}}
                @yield('content')
                {{-- </div> --}}
            </main>
        </div>
    </div>
    <footer class="text-center text-white py-3" style="background-color: rgba(0,0,0,0.2);">
        <div class="container">
            <small>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</small>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>