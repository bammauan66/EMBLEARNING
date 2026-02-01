<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ยินดีต้อนรับ - Wilcom E-Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            overflow: hidden;
            background-color: #dcfce7; /* Light Green background matching app layout */
        }
        
        /* Floating Animation for Logo */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .logo-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Loading Bar */
        .loading-container {
            width: 300px;
            height: 6px;
            background: rgba(0,0,0,0.1); /* Darker track for light bg */
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            margin-top: 2rem;
        }
        .loading-bar {
            width: 0%;
            height: 100%;
            background: #22c55e; /* Green-500 */
            border-radius: 10px;
            animation: loadProgress 3.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            box-shadow: 0 0 10px #22c55e;
        }
        @keyframes loadProgress {
            0% { width: 0%; }
            40% { width: 70%; }
            80% { width: 90%; }
            100% { width: 100%; }
        }

        /* Fade Out Loader & Fade In Button */
        .fade-out {
            animation: fadeOut 0.5s ease-out forwards;
            animation-delay: 3.5s;
        }
        .fade-in-btn {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease-out forwards;
            animation-delay: 3.8s;
            margin-top: 3rem; /* Add margin instead of absolute positioning */
        }

        @keyframes fadeOut {
            to { opacity: 0; visibility: hidden; width: 0; height: 0; margin: 0; }
        }
        @keyframes fadeInUp {
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
            z-index: 0;
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
            border-radius: 50%;
        }
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
<body class="flex items-center justify-center min-h-screen text-gray-800 relative">

    <!-- Animated Background Bubbles HTML -->
    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>
    
    <!-- Particles (Optional overlay) -->
    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 brightness-100 contrast-150 mix-blend-overlay pointer-events-none"></div>

    <div class="relative z-10 flex flex-col items-center text-center px-4 w-full max-w-4xl mx-auto">
        
        <!-- Logo -->
        <div class="logo-float mb-8 bg-white/50 backdrop-blur-md p-6 rounded-3xl shadow-xl border border-white/40">
            <img src="{{ asset('img/logo_new.png') }}" alt="Wilcom Logo" class="h-24 md:h-32 w-auto drop-shadow-md">
        </div>

        <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-2 drop-shadow-sm text-gray-900">
            Wilcom E-Learning
        </h1>
        <p class="text-lg md:text-xl text-gray-600 font-light mb-8 tracking-wide">
            เรียนรู้การปักผ้าด้วยโปรแกรมมืออาชีพ
        </p>

        <!-- Loading Section -->
        <div class="loading-wrapper fade-out w-full flex flex-col items-center justify-center h-20">
            <p class="text-xs text-gray-500 uppercase tracking-widest mb-2 font-semibold">Loading System</p>
            <div class="loading-container">
                <div class="loading-bar"></div>
            </div>
        </div>

        <!-- Enter Button (Flow layout, hidden initially) -->
        <div class="fade-in-btn"> 
            <a href="{{ route('login') }}" 
               class="group relative inline-flex items-center justify-center px-10 py-4 font-bold text-white transition-all duration-200 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full focus:outline-none focus:ring-4 focus:ring-green-300 hover:from-green-600 hover:to-emerald-700 hover:shadow-lg hover:scale-105 active:scale-95 shadow-md">
                <span class="mr-2 text-lg">เข้าสู่ระบบ</span>
                <svg class="w-6 h-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
            <p class="mt-4 text-sm text-gray-500 font-light">กดปุ่มเพื่อเริ่มต้นการเรียนรู้</p>
        </div>

    </div>

</body>
</html>
