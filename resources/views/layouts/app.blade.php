<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Learning Wilcom</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#008a00", // Vibrant green from the header
                        "primary-dark": "#006400",
                        "background-light": "#dcfce7", // Green-100 for slightly darker background
                        "background-dark": "#0f172a", // Dark slate for dark mode
                        "card-light": "#ffffff",
                        "card-dark": "#1e293b",
                        "text-light": "#1f2937",
                        "text-dark": "#e2e8f0",
                        "accent-green": "#22c55e",
                    },
                    fontFamily: {
                        sans: ["'Sarabun'", "sans-serif"],
                        display: ["'Sarabun'", "sans-serif"],
                        body: ["'Sarabun'", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        'xl': '1rem',
                        '2xl': '1.5rem',
                    },
                    boxShadow: {
                        'soft': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                        'hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                    }
                },
            },
        };
    </script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        /* Global Page Transition */
        main {
            animation: fadeSlideUp 0.8s ease-out;
            position: relative;
            z-index: 10; /* Ensure content is above bubbles */
        }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Animated Background Bubbles */
        .circles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1; /* Bring above body background */
            pointer-events: none;
        }
        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(34, 197, 94, 0.4);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%; /* Always round */
        }
        /* More particles for continuous flow */
        .circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
        .circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
        .circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
        .circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
        .circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
        .circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
        .circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
        .circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
        .circles li:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-delay: 2s; animation-duration: 35s; }
        .circles li:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s; animation-duration: 11s; }
        .circles li:nth-child(11) { left: 15%; width: 40px; height: 40px; animation-delay: 5s; animation-duration: 20s; }
        .circles li:nth-child(12) { left: 90%; width: 30px; height: 30px; animation-delay: 1s; animation-duration: 15s; }
        .circles li:nth-child(13) { left: 5%; width: 50px; height: 50px; animation-delay: 8s; animation-duration: 22s; }
        .circles li:nth-child(14) { left: 60%; width: 15px; height: 15px; animation-delay: 6s; animation-duration: 30s; }
        .circles li:nth-child(15) { left: 30%; width: 90px; height: 90px; animation-delay: 9s; animation-duration: 28s; }
        
        @keyframes animate {
            0% { transform: translateY(0) rotate(0deg); opacity: 0.4; border-radius: 50%; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark min-h-screen flex flex-col font-body transition-colors duration-300">
    <!-- Animated Background Bubbles HTML -->
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <header class="bg-primary text-white shadow-md z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <div class="bg-white p-1 rounded shadow-sm">
                    <img alt="Wilcom Logo" class="h-8 w-auto" src="{{ asset('img/logo_new.png') }}"/>
                </div>
                <h1 class="text-lg font-semibold tracking-wide hidden sm:block">Wilcom E-Learning System</h1>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-6 text-sm font-medium">
                @auth
                <div class="text-right leading-tight hidden md:block">
                    <p class="text-green-100 text-xs">สวัสดี</p>
                    <p class="font-bold">{{ Auth::user()->name }}</p>
                </div>
                
                <nav class="hidden md:flex items-center space-x-6">
                    @if(auth()->user()->role === 'teacher')
                        <a class="hover:text-green-100 transition-colors flex items-center space-x-1 {{ request()->routeIs('admin.*') ? 'font-bold underline' : '' }}" href="{{ route('admin.dashboard') }}">
                            <span class="material-icons-outlined text-lg">admin_panel_settings</span>
                            <span>Admin Panel</span>
                        </a>
                        <!-- Progress for Admin returns Analytics Table -->
                        <a class="hover:text-green-100 transition-colors flex items-center space-x-1 {{ request()->routeIs('progress') ? 'font-bold underline' : '' }}" href="{{ route('progress') }}">
                            <span class="material-icons-outlined text-lg">bar_chart</span>
                            <span>ความคืบหน้า</span>
                        </a>
                    @else
                        <a class="hover:text-green-100 transition-colors flex items-center space-x-1 {{ request()->routeIs('dashboard') ? 'font-bold underline' : '' }}" href="{{ route('dashboard') }}">
                            <span class="material-icons-outlined text-lg">home</span>
                            <span>หน้าหลัก</span>
                        </a>
                         <a class="hover:text-green-100 transition-colors flex items-center space-x-1 {{ request()->routeIs('progress') ? 'font-bold underline' : '' }}" href="{{ route('progress') }}">
                            <span class="material-icons-outlined text-lg">trending_up</span>
                            <span>ความคืบหน้า</span>
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                        @csrf
                        <button type="submit" class="hover:text-green-100 transition-colors flex items-center space-x-1">
                            <span class="material-icons-outlined text-lg">logout</span>
                            <span class="hidden lg:inline">ออกจากระบบ</span>
                        </button>
                    </form>
                </nav>
                @else
                   <a href="{{ route('login') }}" class="hover:text-green-100">เข้าสู่ระบบ</a>
                @endauth
                
                <!-- Mobile Menu Button (simplified) -->
                <button class="md:hidden p-2 rounded-md hover:bg-primary-dark focus:outline-none">
                    <span class="material-icons-outlined">menu</span>
                </button>
            </div>
        </div>
    </header>

    <main class="flex-grow p-4 sm:p-6 lg:p-8">
        <div class="max-w-7xl mx-auto">
             @yield('content')
        </div>
    </main>

    <footer class="bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 dark:text-gray-400 text-sm">
            © {{ date('Y') }} Wilcom E-Learning System. All rights reserved.
        </div>
    </footer>
</body>
</html>
