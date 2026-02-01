@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary mb-2 transition-colors">
                    <span class="material-icons-outlined text-sm mr-1">arrow_back</span>
                    กลับสู่แดชบอร์ด
                </a>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-3">
                    <span class="p-2 bg-green-100 dark:bg-green-900/50 rounded-lg text-primary dark:text-green-400">
                        <span class="material-icons-outlined text-2xl">analytics</span>
                    </span>
                    สถิติการเรียน: {{ $lesson->title }}
                </h1>
                <p class="text-gray-500 mt-1 ml-14">รายชื่อผู้เรียนและคะแนนสอบ</p>
            </div>
        </div>

        <!-- Scores Table -->
        <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-soft sm:rounded-2xl border border-gray-100 dark:border-slate-700">
            <div class="p-6 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">ประวัติการสอบ ({{ count($scores) }} รายการ)</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-slate-700/50 text-gray-500 dark:text-gray-400 text-sm uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold rounded-tl-lg">ผู้เรียน</th>
                            <th class="px-6 py-4 font-semibold">ประเภทสอบ</th>
                            <th class="px-6 py-4 font-semibold text-center">คะแนนที่ได้</th>
                            <th class="px-6 py-4 font-semibold text-center">ตอบถูก</th>
                            <th class="px-6 py-4 font-semibold text-center">ตอบผิด</th>
                            <th class="px-6 py-4 font-semibold text-center">ผลลัพธ์</th>
                            <th class="px-6 py-4 font-semibold text-right rounded-tr-lg">วันที่สอบ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                        @forelse($scores as $score)
                            @php
                                $isPost = $score->type === 'post';
                                $wrong = $totalQuestions - $score->score;
                                if($wrong < 0) $wrong = 0; // Just in case
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center text-gray-500 font-bold">
                                            {{ substr($score->user_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $score->user_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $score->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($score->type === 'final')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Final Exam
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium {{ $isPost ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $isPost ? 'Post-test' : 'Pre-test' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($score->type === 'pre')
                                        <span class="text-gray-400">-</span>
                                    @else
                                        <span class="text-lg font-bold {{ $score->pass ? 'text-green-600' : 'text-gray-600' }}">
                                            {{ $score->score }} / {{ $totalQuestions }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($score->type === 'pre')
                                        <span class="text-gray-400">-</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-green-600 font-medium bg-green-50 px-3 py-1 rounded-lg">
                                            <span class="material-icons-outlined text-sm">check_circle</span>
                                            {{ $score->score }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($score->type === 'pre')
                                        <span class="text-gray-400">-</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-red-500 font-medium bg-red-50 px-3 py-1 rounded-lg">
                                            <span class="material-icons-outlined text-sm">cancel</span>
                                            {{ $wrong }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($score->pass)
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                            {{ $score->type === 'pre' ? 'COMPLETED' : 'PASS' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                            FAIL
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-gray-500 text-sm">
                                    {{ \Carbon\Carbon::parse($score->created_at)->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                    <span class="material-icons-outlined text-4xl mb-2 block">assignment_late</span>
                                    ไม่มีข้อมูลการสอบในบทเรียนนี้
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
