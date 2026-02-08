<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>E-Learning Dashboard</title>
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
        
        /* Animations */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.05); }
        }
        .animate-pulse-slow {
            animation: pulse-slow 4s ease-in-out infinite;
        }

        @keyframes unlockPulse {
            0% { transform: scale(1); filter: grayscale(1); box-shadow: 0 0 0 rgba(0,0,0,0); }
            40% { transform: scale(1.05); filter: grayscale(0.5); }
            60% { transform: scale(1.05); filter: grayscale(0); box-shadow: 0 0 30px rgba(34, 197, 94, 0.6); }
            100% { transform: scale(1); filter: grayscale(0); box-shadow: 0 0 0 rgba(0,0,0,0); }
        }
        .unlock-animation {
            animation: unlockPulse 1.5s ease-out forwards;
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
                <p class="text-xs text-gray-400">ผู้ใช้งาน</p>
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
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-white opacity-5" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700 animate-pulse-slow"></div>
        
        <div class="relative z-10 px-8 py-12 md:px-16 md:py-16 text-white">
            <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm text-xs font-semibold uppercase tracking-wider mb-4 border border-white/30 animate-fade-in-up delay-100">
                ยินดีต้อนรับ
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight animate-fade-in-up delay-100">
                ระบบการเรียนรู้ <br/>Wilcom Embroidery Studio
            </h2>
            <p class="text-green-50 text-lg md:text-xl max-w-2xl font-light mb-8 animate-fade-in-up delay-200">
                เริ่มต้นการเรียนรู้ของคุณตั้งแต่วันนี้ ติดตามความคืบหน้าและพัฒนาทักษะการปักผ้าอย่างมืออาชีพ
            </p>
        </div>
    </div>

    <!-- Certificate Banner (Unlocked) -->
    @if($hasCertificate ?? false)
    <div class="mb-12 animate-fade-in-up delay-200">
       <div class="bg-gradient-to-r from-amber-200 to-yellow-400 rounded-2xl p-1 shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
           <div class="bg-white dark:bg-slate-800 rounded-xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
               <div class="absolute right-0 top-0 w-64 h-64 bg-yellow-100 rounded-full opacity-50 blur-3xl -mr-16 -mt-16 pointer-events-none animate-pulse-slow"></div>
               
               <div class="flex items-center gap-6 z-10">
                   <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 shadow-inner">
                       <span class="material-icons-outlined text-4xl">emoji_events</span>
                   </div>
                   <div>
                       <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">ยินดีด้วย! คุณเรียนจบหลักสูตรแล้ว</h3>
                       <p class="text-gray-600 dark:text-gray-300">คุณผ่านการทดสอบ Final Exam เรียบร้อยแล้ว</p>
                   </div>
               </div>
               
               <a href="{{ route('certificate.show') }}" class="z-10 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-yellow-500/30 hover:-translate-y-1 transition-all duration-300 flex items-center gap-2 whitespace-nowrap group">
                    <span class="material-icons-outlined group-hover:rotate-12 transition-transform">card_membership</span>
                    <span>รับใบประกาศนียบัตร</span>
               </a>
           </div>
       </div>
    </div>
    @endif

    <!-- Content Grid -->
    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 pl-2 border-l-4 border-primary animate-fade-in-up delay-200">
        แผนการเรียนรู้
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        
        <!-- 1. Pre-test Card (Conditional) -->
        <!-- Shows if not done, or allows review -->
        <div class="group relative bg-white/90 backdrop-blur-sm dark:bg-slate-800/90 rounded-2xl shadow-card hover:shadow-2xl hover:shadow-blue-500/10 border border-gray-100 dark:border-slate-700 transition-all duration-300 flex flex-col h-full overflow-hidden hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 200ms">
            <!-- Header -->
            <div class="h-32 bg-gradient-to-br from-blue-500 to-indigo-600 relative flex items-center justify-center overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white opacity-10 rounded-full blur-md group-hover:scale-150 transition-transform duration-500"></div>
                <span class="material-icons-outlined text-6xl text-white opacity-90 group-hover:scale-110 transition-transform duration-500">quiz</span>
            </div>
            
            <div class="p-6 flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-4">
                     <span class="inline-block py-1 px-3 rounded-md text-[10px] font-bold tracking-wider uppercase bg-blue-100 text-blue-600">
                        PRE-TEST
                    </span>
                    @if($hasCoursePretest ?? false)
                        <span class="material-icons-outlined text-green-500">check_circle</span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">แบบทดสอบก่อนเรียน</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">วัดระดับความรู้พื้นฐานของคุณก่อนเข้าสู่บทเรียนจริง</p>
                
                <div class="mt-auto pt-4">
                    @if($hasCoursePretest ?? false)
                         <button disabled class="w-full bg-gray-50 text-gray-400 font-medium py-2.5 rounded-xl border border-gray-100 flex items-center justify-center gap-2 cursor-default">
                             <span class="material-icons-outlined text-sm">check</span>
                            <span>ทำแบบทดสอบแล้ว</span>
                        </button>
                    @else
                        <a href="{{ route('course.pretest') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 transition-all duration-300 flex items-center justify-center gap-2 group-hover:gap-3">
                            <span>เริ่มทำแบบทดสอบ</span>
                            <span class="material-icons-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- 2. Lessons Loop -->
        @php
            $previousLessonPassed = $hasCoursePretest ?? false;
        @endphp
        @foreach($lessons as $lesson)
            @php
                $isLocked = true; 
                
                if ($hasCertificate ?? false) {
                    $isLocked = false;
                } else {
                    // Unlock if previous lesson was passed (initially checking pretest)
                    $isLocked = !$previousLessonPassed;
                }
                
                // Check if current lesson is passed for the next iteration
                $currentLessonPassed = in_array($lesson->id, $passedLessons ?? []);
            @endphp

            <div id="lesson-card-{{ $lesson->id }}" class="group relative bg-white/90 backdrop-blur-sm dark:bg-slate-800/90 rounded-2xl shadow-card hover:shadow-2xl hover:shadow-green-500/10 border border-gray-100 dark:border-slate-700 transition-all duration-300 flex flex-col h-full overflow-hidden {{ $isLocked ? 'grayscale opacity-75' : 'hover:-translate-y-2' }} animate-fade-in-up" style="animation-delay: {{ 300 + ($lesson->id * 50) }}ms">
                
                <!-- Lesson Header -->
                 <div class="h-32 bg-gradient-to-br {{ $isLocked ? 'from-gray-100 to-gray-200' : 'from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20' }} relative flex items-center justify-center overflow-hidden">
                     @if($isLocked)
                        <span class="material-icons-outlined text-6xl text-gray-300">lock</span>
                     @else
                        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-200 dark:bg-green-800 rounded-full opacity-20 group-hover:scale-150 transition-transform duration-500"></div>
                        <span class="text-6xl font-black text-green-100 dark:text-green-900 select-none transform group-hover:scale-110 transition-transform duration-500">{{ $lesson->id }}</span>
                     @endif
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-4">
                        <span class="inline-block py-1 px-3 rounded-md text-[10px] font-bold tracking-wider uppercase {{ $isLocked ? 'bg-gray-100 text-gray-500' : 'bg-green-100 text-green-600' }}">
                            {{ $isLocked ? 'LOCKED' : 'LESSON ' . $lesson->id }}
                        </span>
                        @if(in_array($lesson->id, $passedLessons ?? []))
                            <span class="material-icons-outlined text-green-500" title="Completed">check_circle</span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 line-clamp-2 md:min-h-[3.5rem] group-hover:text-primary transition-colors">
                        {{ $lesson->title }}
                    </h3>
                    
                    <div class="mt-auto pt-4">
                        @if($isLocked)
                            <button disabled class="w-full bg-gray-50 dark:bg-slate-700 text-gray-400 font-medium py-2.5 rounded-xl border border-gray-100 dark:border-slate-600 flex items-center justify-center gap-2 cursor-not-allowed">
                                <span class="material-icons-outlined text-sm">lock</span>
                                <span>ล็อค</span>
                            </button>
                        @else
                             @if(in_array($lesson->id, $passedLessons ?? []))
                                 <a href="{{ route('lesson.show', $lesson->id) }}" class="w-full bg-green-50 hover:bg-green-100 text-green-700 font-medium py-2.5 rounded-xl border border-green-200 transition-all duration-300 flex items-center justify-center gap-2 group">
                                    <span>ทบทวน</span>
                                    <span class="material-icons-outlined text-sm">replay</span>
                                </a>
                             @else
                                <a href="{{ route('test.pre', $lesson->id) }}" class="w-full bg-primary hover:bg-primary-dark text-white font-medium py-2.5 rounded-xl shadow-lg shadow-green-500/20 hover:shadow-green-500/40 transition-all duration-300 flex items-center justify-center gap-2 group-hover:gap-3">
                                    <span>เริ่มเรียน</span>
                                    <span class="material-icons-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                                </a>
                             @endif
                        @endif
                    </div>
                </div>
            </div>
            @php
                // Update tracker for next loop
                $previousLessonPassed = $currentLessonPassed;
            @endphp
        @endforeach

        <!-- 3. Final Exam Card -->
        <!-- Logic: If certificate exists, use the unlock banner above. Else, show this card -->
        @if(!($hasCertificate ?? false))
        <div id="final-exam-card" class="group relative bg-white/90 backdrop-blur-sm dark:bg-slate-800/90 rounded-2xl shadow-card hover:shadow-2xl hover:shadow-purple-500/10 border border-gray-100 dark:border-slate-700 transition-all duration-300 flex flex-col h-full overflow-hidden hover:-translate-y-2 animate-fade-in-up opacity-90" style="animation-delay: 800ms">
             <div class="h-32 bg-gradient-to-br from-purple-500 to-pink-600 relative flex items-center justify-center overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white opacity-10 rounded-full blur-md group-hover:scale-150 transition-transform duration-500"></div>
                <span class="material-icons-outlined text-6xl text-white opacity-90 group-hover:rotate-12 transition-transform duration-500">edit_document</span>
            </div>
            
            <div class="p-6 flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-4">
                     <span class="inline-block py-1 px-3 rounded-md text-[10px] font-bold tracking-wider uppercase bg-purple-100 text-purple-600">
                        FINAL EXAM
                    </span>
                </div>

                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2">แบบทดสอบหลังเรียน</h3>
                <p class="text-sm text-gray-500 mb-4">บททดสอบสุดท้ายเพื่อวัดผลสัมฤทธิ์และรับใบประกาศนียบัตร</p>
                
                <div class="mt-auto pt-4">
                    @if(count($passedLessons ?? []) >= 5)
                        <a href="{{ route('final.exam') }}" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2.5 rounded-xl shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 transition-all duration-300 flex items-center justify-center gap-2 group-hover:gap-3">
                            <span>เริ่มสอบ</span>
                            <span class="material-icons-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    @else
                         <button disabled class="w-full bg-gray-50 text-gray-400 font-medium py-2.5 rounded-xl border border-gray-100 flex items-center justify-center gap-2 cursor-not-allowed">
                             <span class="material-icons-outlined text-sm">lock</span>
                            <span>ต้องเรียนจบทุกบทก่อน</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endif

    </div>

</main>

<footer class="bg-white dark:bg-slate-900 border-t border-gray-200 dark:border-slate-800 mt-12 py-8">
    <div class="max-w-7xl mx-auto px-4 text-center">
         <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">© {{ date('Y') }} Wilcom E-Learning System. All rights reserved.</p>
    </div>
</footer>

<!-- Fireworks Script (Preserved for UX) -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('unlocked_lesson') || session('unlocked_final'))
            // Fireworks Effect
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function randomInRange(min, max) {
              return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
              var timeLeft = animationEnd - Date.now();
              if (timeLeft <= 0) return clearInterval(interval);
              var particleCount = 50 * (timeLeft / duration);
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        @endif

        @if(session('unlocked_lesson'))
            const unlockedId = "{{ session('unlocked_lesson') }}";
            const card = document.getElementById('lesson-card-' + unlockedId);
            if(card) {
                card.classList.remove('opacity-75', 'grayscale');
                card.classList.add('unlock-animation', 'ring-2', 'ring-green-400', 'ring-offset-2');
                card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        @endif
        
        @if(session('unlocked_final'))
            const finalCard = document.getElementById('final-exam-card');
            if(finalCard) {
                 finalCard.classList.remove('opacity-90');
                 finalCard.classList.add('unlock-animation', 'ring-2', 'ring-purple-400', 'ring-offset-2');
                 finalCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        @endif
    });
</script>

</body>
</html>
