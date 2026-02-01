@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-green-50 overflow-hidden font-body">
    <!-- Animated Background Bubbles -->
    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <!-- Header Section -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-6">
        <div class="flex flex-col md:flex-row justify-between items-center bg-white/80 backdrop-blur-md rounded-2xl p-6 shadow-soft animate-fade-in-up md:space-y-0 space-y-4">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-gradient-to-tr from-green-500 to-teal-400 rounded-full shadow-lg">
                    <span class="material-icons-outlined text-white text-3xl">library_books</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">จัดการบทเรียน</h2>
                    <p class="text-gray-500 text-sm">Course Management System</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-800 transition shadow-sm font-semibold">
                    <span class="material-icons-outlined text-lg">arrow_back</span>
                    <span>กลับหน้า Admin</span>
                </a>
                <a href="{{ route('admin.lessons.create') }}" class="flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-green-600 to-teal-500 text-white hover:from-green-700 hover:to-teal-600 transition shadow-lg transform hover:-translate-y-0.5 font-semibold">
                    <span class="material-icons-outlined text-lg">add_circle</span>
                    <span>เพิ่มบทเรียนใหม่</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 z-10">
        @if(session('success'))
            <div class="animate-fade-in-up mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex items-center justify-between">
                <div class="flex items-center">
                    <span class="material-icons-outlined text-green-500 mr-2">check_circle</span>
                    <span class="text-green-700 font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden animate-fade-in-up delay-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-green-50 to-teal-50 text-green-800 border-b border-green-100">
                            <th class="p-5 font-bold uppercase text-sm tracking-wider">บทที่</th>
                            <th class="p-5 font-bold uppercase text-sm tracking-wider">ชื่อบทเรียน</th>
                            <th class="p-5 font-bold uppercase text-sm tracking-wider">คำอธิบาย</th>
                            <th class="p-5 font-bold uppercase text-sm tracking-wider text-right">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($lessons as $lesson)
                            <tr class="hover:bg-green-50/50 transition duration-150 group">
                                <td class="p-5">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-100 text-green-700 font-bold mb-0 shadow-sm group-hover:bg-green-200 transition">
                                        {{ $lesson->id }}
                                    </span>
                                </td>
                                <td class="p-5">
                                    <div class="font-bold text-gray-800 text-lg group-hover:text-green-700 transition">{{ $lesson->title }}</div>
                                </td>
                                <td class="p-5">
                                    <p class="text-gray-500 text-sm max-w-md truncate">{{ $lesson->description }}</p>
                                </td>
                                <td class="p-5 text-right space-x-2">
                                    <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition font-medium text-sm">
                                        <span class="material-icons-outlined text-base mr-1">edit</span> แก้ไข
                                    </a>
                                    <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" class="inline-block" onsubmit="return confirm('คุณต้องการลบบทเรียนนี้ใช่หรือไม่?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 hover:text-red-700 transition font-medium text-sm">
                                            <span class="material-icons-outlined text-base mr-1">delete</span> ลบ
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($lessons->isEmpty())
                <div class="p-12 text-center text-gray-400">
                    <span class="material-icons-outlined text-6xl mb-4 text-gray-300">sentiment_dissatisfied</span>
                    <p class="text-lg">ยังไม่มีบทเรียนในระบบ</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Animated Background Bubbles */
    .circles {
        position: absolute;
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
        background: rgba(34, 197, 94, 0.15); /* Green-500 with opacity */
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
    
    .shadow-soft {
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
    }
</style>
@endsection
