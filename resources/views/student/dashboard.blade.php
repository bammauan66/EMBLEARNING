<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>E-Learning Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#059669", // Emerald 600
                        "primary-dark": "#047857", // Emerald 700
                        "primary-light": "#d1fae5", // Emerald 100
                        "background-light": "#f8fafc", // Slate 50
                        "card-light": "#ffffff",
                    },
                    fontFamily: {
                        body: ["'Sarabun'", "sans-serif"],
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                        'hover': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
                    }
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Sarabun', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
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
            background: rgba(34, 197, 94, 0.2); /* Green-500 with opacity */
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
        
        @keyframes animate {
            0% { transform: translateY(0) rotate(0deg); opacity: 0.4; border-radius: 50%; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }

        /* Animations */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.1; transform: scale(1); }
            50% { opacity: 0.3; transform: scale(1.1); }
        }
        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-slate-900 text-gray-800 dark:text-gray-200 min-h-screen flex flex-col font-body relative">

<!-- Modern Header -->
<header class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md shadow-sm sticky top-0 z-50 transition-colors duration-300 border-b border-green-100 dark:border-slate-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-500 rounded-xl flex items-center justify-center text-white shadow-lg">
                <span class="material-icons-outlined">school</span>
            </div>
            <div>
                <h1 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300">
                    Wilcom E-Learning
                </h1>
                <p class="text-xs text-gray-500 -mt-1 hidden sm:block">Empower Your Embroidery Skills</p>
            </div>
        </div>
        
        <div class="flex items-center gap-6">
            <div class="text-right hidden md:block">
                <p class="text-xs text-gray-400">ยินดีต้อนรับ,</p>
                <p class="font-bold text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-10 h-10 rounded-full bg-white dark:bg-slate-700 hover:bg-red-50 hover:text-red-500 flex items-center justify-center transition-colors shadow-sm border border-gray-100">
                    <span class="material-icons-outlined">logout</span>
                </button>
            </form>
        </div>
    </div>
</header>

<main class="flex-grow p-6 lg:p-10 relative z-10 w-full max-w-7xl mx-auto">
    
    <!-- Hero Section -->
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-green-600 to-teal-600 shadow-2xl mb-12 transform hover:scale-[1.01] transition-transform duration-500 group animate-fade-in-up">
        <div class="absolute inset-0 bg-cover bg-center opacity-20 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1544253303-3ac86178c7c2?q=80&w=2692&auto=format&fit=crop');"></div>
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700 animate-pulse-slow"></div>
        
        <div class="relative z-10 px-8 py-12 md:px-16 md:py-16 text-white">
            <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm text-xs font-semibold uppercase tracking-wider mb-4 border border-white/30 animate-fade-in-up delay-100">
                หลักสูตรออนไลน์
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight animate-fade-in-up delay-100">
                ระบบการเรียนรู้ <br/>Wilcom Embroidery Studio
            </h2>
            <p class="text-green-50 text-lg md:text-xl max-w-2xl font-light mb-8 animate-fade-in-up delay-200">
                เรียนรู้เทคนิคการปักผ้าแบบมืออาชีพ ตั้งแต่พื้นฐานจนถึงระดับสูง ด้วยบทเรียนที่เข้าใจง่ายและทันสมัย
            </p>
            <div class="flex flex-wrap gap-4 animate-fade-in-up delay-300">
                <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-colors">
                    <span class="material-icons-outlined text-green-300">play_circle</span>
                    <span>5 บทเรียนวิดีโอ</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-colors">
                    <span class="material-icons-outlined text-green-300">quiz</span>
                    <span>ทดสอบก่อน/หลังเรียน</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm border border-white/20 hover:bg-white/20 transition-colors">
                     <span class="material-icons-outlined text-green-300">verified</span>
                    <span>ใบประกาศนียบัตร</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificate Banner (Unlocked) -->
     @if($hasCertificate ?? false)
     <div class="mb-12 animate-fade-in-up delay-200">
        <div class="bg-gradient-to-r from-amber-200 to-yellow-400 rounded-2xl p-1 shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div class="absolute right-0 top-0 w-64 h-64 bg-yellow-100 rounded-full opacity-50 blur-3xl -mr-16 -mt-16 pointer-events-none animate-pulse-slow"></div>
                
                <div class="flex items-center gap-6 z-10">
                    <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 shadow-inner animate-float">
                        <span class="material-icons-outlined text-4xl">emoji_events</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">ยินดีด้วย! คุณเรียนจบหลักสูตรแล้ว</h3>
                        <p class="text-gray-600 dark:text-gray-300">คุณผ่านการทดสอบ Final Exam เรียบร้อยแล้ว สามารถรับใบประกาศนียบัตรได้เลย</p>
                    </div>
                </div>
                
                <a href="{{ route('certificate.show') }}" class="z-10 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-yellow-500/30 hover:-translate-y-1 transition-all duration-300 flex items-center gap-2 whitespace-nowrap group">
                     <span class="material-icons-outlined group-hover:rotate-12 transition-transform">card_membership</span>
                     <span>ดูใบประกาศฯ</span>
                </a>
            </div>
        </div>
     </div>
     @endif

    <!-- Lessons Grid -->
    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 pl-2 border-l-4 border-primary animate-fade-in-up delay-200">
        บทเรียนของคุณ
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        
        @foreach($lessons as $lesson)
            @php
                $isLocked = true; // Default to locked
                
                // If user has passed the course (Final Exam), unlock EVERYTHING
                if ($hasCertificate ?? false) {
                    $isLocked = false;
                } else {
                    // Normal Progression Logic
                    if ($lesson->id == 1) {
                        $isLocked = !($hasCoursePretest ?? false);
                    } else {
                        $prevId = $lesson->id - 1;
                        $passed = $passedLessons ?? [];
                        $isLocked = !in_array($prevId, $passed);
                    }
                }
            @endphp

            <!-- Custom Card Layout -->
            <div class="group relative bg-white/90 backdrop-blur-sm dark:bg-slate-800/90 rounded-2xl shadow-card hover:shadow-2xl hover:shadow-green-500/10 border border-gray-100 dark:border-slate-700 transition-all duration-300 flex flex-col h-full overflow-hidden {{ $isLocked ? 'grayscale opacity-75' : 'hover:-translate-y-2' }} animate-fade-in-up" style="animation-delay: {{ 300 + ($lesson->id * 100) }}ms">
                
                <!-- Card Header / Image Placeholder -->
                <div class="h-32 bg-gradient-to-br {{ $isLocked ? 'from-gray-100 to-gray-200' : 'from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20' }} relative flex items-center justify-center overflow-hidden">
                     @if($isLocked)
                        <span class="material-icons-outlined text-6xl text-gray-300">lock</span>
                     @else
                        <!-- Abstract circle decorations -->
                        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-200 dark:bg-green-800 rounded-full opacity-20 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="absolute left-4 top-4 w-12 h-12 bg-teal-200 dark:bg-teal-800 rounded-full opacity-20 animate-pulse-slow"></div>
                        <span class="text-6xl font-black text-green-100 dark:text-green-900 select-none transform group-hover:scale-110 transition-transform duration-500">{{ $lesson->id }}</span>
                     @endif
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <!-- Badge -->
                    <div class="flex justify-between items-start mb-4">
                        <span class="inline-block py-1 px-3 rounded-md text-[10px] font-bold tracking-wider uppercase {{ $isLocked ? 'bg-gray-100 text-gray-500' : 'bg-green-100 text-green-600' }}">
                            {{ $isLocked ? 'LOCKED' : 'LESSON ' . $lesson->id }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 line-clamp-2 leading-tight min-h-[3rem] group-hover:text-primary transition-colors">
                        {{ $lesson->title }}
                    </h3>
                    
                    <div class="mt-auto pt-6">
                        @if($isLocked)
                            <button disabled class="w-full bg-gray-50 dark:bg-slate-700 text-gray-400 font-medium py-2.5 rounded-xl border border-gray-100 dark:border-slate-600 flex items-center justify-center gap-2 cursor-not-allowed">
                                <span class="material-icons-outlined text-sm">lock</span>
                                <span>ล็อค</span>
                            </button>
                        @else
                            <a href="{{ route('test.pre', $lesson->id) }}" class="w-full bg-primary hover:bg-primary-dark text-white font-medium py-2.5 rounded-xl shadow-lg shadow-green-500/20 hover:shadow-green-500/40 transition-all duration-300 flex items-center justify-center gap-2 group-hover:gap-3">
                                <span>เริ่มเรียน</span>
                                <span class="material-icons-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</main>

<footer class="bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 mt-12 py-8">
    <div class="max-w-7xl mx-auto px-4 text-center">
         <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">© 2025 Wilcom E-Learning System. All rights reserved.</p>
         <p class="text-gray-400 text-xs mt-2">Designed for Excellence.</p>
    </div>
</footer>

</body>
</html>
