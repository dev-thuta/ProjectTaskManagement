<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project Task Management | User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="sidebar">
        <label class="theme-toggle">
            <input type="checkbox" id="themeToggle">
            <span class="theme-slider"></span>
        </label>

        <a href="{{ url('/front/users/') }}" class="sidebar-item {{ request()->is('front/users') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
        </a>

        <a href="{{ url('/front/users/teams') }}"
            class="sidebar-item {{ request()->is('front/users/teams') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
        </a>

        <a href="{{ url('/front/users/view-profile') }}" class="sidebar-item {{ request()->is('front/users/view-profile') ? 'active' : '' }}">
            <i class="fa-solid fa-user"></i>
        </a>

        <a href="{{ url('front/users/tasks' )}}" class="sidebar-item {{ request()->is('front/users/tasks') ? 'active' : '' }}">
            <i class="fa-solid fa-list-check"></i>
        </a>

        <a href="{{ url('front/users/login') }}"
            class="sidebar-item {{ request()->is('front/users/login') ? 'active' : '' }}">
            <i class="fas fa-door-open"></i>
        </a>
    </div>


    <div class="main-content">
        @yield('content')
    </div>

    @stack('scripts')
    <script>
        class ThemeManager {
            constructor() {
                this.themeToggle = document.getElementById('themeToggle');
                if (!this.themeToggle) {
                    console.error("Theme toggle button with ID 'themeToggle' not found.");
                    return;
                }
                this.init();
            }

            init() {
                const savedTheme = localStorage.getItem('theme') || 'dark'; // Default to dark
                this.setTheme(savedTheme);
                this.themeToggle.checked = (savedTheme === 'dark');

                this.themeToggle.addEventListener('change', () => {
                    const newTheme = this.themeToggle.checked ? 'dark' : 'light';
                    this.setTheme(newTheme);
                });
            }

            setTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.setAttribute('data-theme', 'dark');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                }
                localStorage.setItem('theme', theme);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            new ThemeManager();
        });
    </script>

</body>

</html>
