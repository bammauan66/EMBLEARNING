@extends('layouts.app')

@section('content')
@section('content')
    <!-- Hero Section -->
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-green-600 to-teal-600 shadow-2xl mb-12 transform hover:scale-[1.01] transition-transform duration-500 group animate-fade-in-up">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-white opacity-5" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700 animate-pulse-slow"></div>
        
        <div class="relative z-10 px-8 py-12 md:px-16 md:py-16 text-white">
            <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-sm text-xs font-semibold uppercase tracking-wider mb-4 border border-white/30 animate-fade-in-up delay-100">
                ADMINISTRATION
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight animate-fade-in-up delay-100">
                ระบบจัดการผู้ดูแลระบบ
            </h2>
            <p class="text-green-50 text-lg md:text-xl max-w-2xl font-light mb-8 animate-fade-in-up delay-200">
                จัดการข้อมูลผู้ใช้งาน บทเรียน และตรวจสอบความคืบหน้าของผู้เรียนได้ที่นี่
            </p>
        </div>
    </div>

    <!-- Stats/Action Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        
        <!-- User Management Card -->
        <a href="{{ route('admin.users.index') }}" class="group relative bg-white/90 backdrop-blur-sm dark:bg-slate-800/90 rounded-2xl shadow-card hover:shadow-2xl hover:shadow-emerald-500/10 border border-gray-100 dark:border-slate-700 transition-all duration-300 flex flex-col overflow-hidden hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 200ms">
             <div class="h-32 bg-gradient-to-br from-emerald-500 to-teal-600 relative flex items-center justify-center overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white opacity-10 rounded-full blur-md group-hover:scale-150 transition-transform duration-500"></div>
                <span class="material-icons-outlined text-6xl text-white opacity-90 group-hover:scale-110 transition-transform duration-500">group</span>
            </div>
            
            <div class="p-6 flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-4">
                     <span class="inline-block py-1 px-3 rounded-md text-[10px] font-bold tracking-wider uppercase bg-emerald-100 text-emerald-600">
                        USERS
                    </span>
                    <span class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalUsers }}</span>
                </div>

                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2 group-hover:text-emerald-600 transition-colors">จัดการผู้ใช้งาน</h3>
                <p class="text-sm text-gray-500 mb-4">เพิ่ม ลบ แก้ไขข้อมูลนักเรียนและผู้ดูแลระบบ</p>
                
                <div class="mt-auto pt-4 flex items-center text-emerald-600 font-semibold group-hover:gap-2 transition-all">
                    <span>จัดการข้อมูล</span>
                    <span class="material-icons-outlined text-sm ml-1 transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </div>
        </a>

        <!-- Lesson Management Card -->
        <a href="{{ route('admin.lessons.index') }}" class="group relative bg-white/90 backdrop-blur-sm dark:bg-slate-800/90 rounded-2xl shadow-card hover:shadow-2xl hover:shadow-blue-500/10 border border-gray-100 dark:border-slate-700 transition-all duration-300 flex flex-col overflow-hidden hover:-translate-y-2 animate-fade-in-up" style="animation-delay: 300ms">
             <div class="h-32 bg-gradient-to-br from-blue-500 to-indigo-600 relative flex items-center justify-center overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white opacity-10 rounded-full blur-md group-hover:scale-150 transition-transform duration-500"></div>
                <span class="material-icons-outlined text-6xl text-white opacity-90 group-hover:scale-110 transition-transform duration-500">library_books</span>
            </div>
            
            <div class="p-6 flex flex-col flex-grow">
                <div class="flex justify-between items-start mb-4">
                     <span class="inline-block py-1 px-3 rounded-md text-[10px] font-bold tracking-wider uppercase bg-blue-100 text-blue-600">
                        LESSONS
                    </span>
                    <span class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalLessons }}</span>
                </div>

                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">จัดการบทเรียน</h3>
                <p class="text-sm text-gray-500 mb-4">เพิ่มเนื้อหา วิดีโอ และแบบทดสอบ</p>
                
                <div class="mt-auto pt-4 flex items-center text-blue-600 font-semibold group-hover:gap-2 transition-all">
                    <span>จัดการข้อมูล</span>
                    <span class="material-icons-outlined text-sm ml-1 transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </div>
        </a>
    </div>

    <!-- Analytics Table Section -->
    <div class="bg-white/90 backdrop-blur-sm dark:bg-slate-800/90 rounded-3xl shadow-card overflow-hidden border border-gray-100 dark:border-slate-700 animate-fade-in-up" style="animation-delay: 400ms">
         <div class="px-8 py-6 border-b border-gray-100 dark:border-slate-700 flex flex-col md:flex-row justify-between items-center bg-gray-50/50 dark:bg-slate-700/30">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <div class="bg-indigo-100 dark:bg-indigo-900/50 p-2 rounded-lg text-indigo-600 dark:text-indigo-400">
                    <span class="material-icons-outlined text-2xl">analytics</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white">สถิติการเรียน (Lesson Analytics)</h3>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                ติดตามความคืบหน้าของผู้เรียนในแต่ละบท
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-slate-700/50 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-8 py-5">บทที่</th>
                        <th class="px-6 py-5">ชื่อบทเรียน</th>
                        <th class="px-6 py-5 w-1/3">ความสำเร็จ (% ผู้เรียนที่ผ่าน)</th>
                        <th class="px-6 py-5 text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-slate-700/50">
                    @foreach($lessonStats as $stat)
                    <tr class="group hover:bg-indigo-50/30 dark:hover:bg-slate-700/30 transition-colors duration-200">
                        <!-- ID / Badge -->
                        <td class="px-8 py-5">
                            @if($stat->id === 'Final')
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-yellow-100 text-yellow-700 font-bold border border-yellow-200 shadow-sm">
                                    <span class="material-icons-outlined text-base">emoji_events</span>
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-slate-700 text-gray-500 font-bold border border-gray-200 dark:border-slate-600 shadow-sm group-hover:border-indigo-200 group-hover:text-indigo-600 transition-colors">
                                    {{ $stat->id }}
                                </span>
                            @endif
                        </td>

                        <!-- Title -->
                        <td class="px-6 py-5">
                            <div class="font-bold text-gray-800 dark:text-gray-100 text-base mb-1 group-hover:text-indigo-600 transition-colors">
                                {{ $stat->title }}
                            </div>
                            <div class="text-xs text-gray-400 flex items-center">
                                <span class="material-icons-outlined text-[10px] mr-1">person</span>
                                ผ่านแล้ว {{ $stat->passed_count }} คน
                            </div>
                        </td>

                        <!-- Progress Bar -->
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-semibold text-gray-600 dark:text-gray-300">ความคืบหน้า</span>
                                <span class="text-xs font-bold {{ $stat->percent >= 80 ? 'text-green-600' : ($stat->percent >= 50 ? 'text-blue-600' : 'text-gray-500') }}">
                                    {{ number_format($stat->percent, 0) }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-slate-600 rounded-full h-2.5 overflow-hidden shadow-inner">
                                <div class="h-2.5 rounded-full {{ $stat->percent >= 100 ? 'bg-gradient-to-r from-green-400 to-green-600' : ($stat->id === 'Final' ? 'bg-gradient-to-r from-yellow-400 to-orange-500' : 'bg-gradient-to-r from-blue-400 to-indigo-500') }}" 
                                     style="width: {{ $stat->percent }}%"></div>
                            </div>
                        </td>

                        <!-- Action Button -->
                        <td class="px-6 py-5 text-center">
                            @if($stat->id === 'Final')
                                <a href="{{ route('admin.lessons.stats', 'final') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-50 text-yellow-600 hover:bg-yellow-100 hover:text-yellow-700 hover:shadow-md hover:scale-105 transition-all duration-200" title="ดูรายละเอียด">
                                    <span class="material-icons-outlined text-lg">visibility</span>
                                </a>
                            @else
                                <a href="{{ route('admin.lessons.stats', $stat->id) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 hover:shadow-md hover:scale-105 transition-all duration-200" title="ดูรายละเอียด">
                                    <span class="material-icons-outlined text-lg">visibility</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Footer of Card -->
        <div class="bg-gray-50 dark:bg-slate-700/30 px-8 py-4 border-t border-gray-100 dark:border-slate-700 flex items-center justify-between">
            <span class="text-xs text-gray-400">อัปเดตล่าสุด: {{ now()->format('d M Y H:i') }}</span>
            <span class="text-xs text-gray-400">ทั้งหมด {{ count($lessonStats) }} รายการ</span>
        </div>
    </div>
@endsection
