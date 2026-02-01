@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-6 text-green-800">สถิติการเรียน (Lesson Analytics)</h1>

<div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-soft p-6 overflow-hidden">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-6 border-l-4 border-green-500 pl-3">สถิติการเรียน (Lesson Analytics)</h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                         <th class="px-5 py-3 bg-gray-50 dark:bg-slate-700 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider rounded-tl-lg">
                            บทที่
                        </th>
                        <th class="px-5 py-3 bg-gray-50 dark:bg-slate-700 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            ชื่อบทเรียน
                        </th>
                        <th class="px-5 py-3 bg-gray-50 dark:bg-slate-700 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider rounded-tr-lg">
                            จำนวนผู้เรียนที่ผ่าน
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessonStats as $stat)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors duration-150">
                            <td class="px-5 py-5 border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm italic text-gray-400">
                                {{ $stat->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm">
                                <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $stat->title }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm text-right">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">{{ $stat->passed_count }} คน ({{ number_format($stat->percent, 0) }}%)</span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 bg-white dark:bg-slate-800 rounded-xl border border-gray-100 dark:border-slate-700 shadow-soft p-6 overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 border-l-4 border-blue-500 pl-3">คะแนนผู้เรียน (Student Scores)</h3>
            
            <form action="{{ route('progress') }}" method="GET" class="w-full md:w-auto mt-4 md:mt-0">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ค้นหาชื่อนักเรียน..." class="w-full md:w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-slate-700 dark:text-gray-200">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <button type="submit" class="absolute right-2 top-2 bg-blue-600 text-white text-xs px-2 py-1 rounded hover:bg-blue-700">ค้นหา</button>
                </div>
            </form>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                         <th class="px-5 py-3 bg-gray-50 dark:bg-slate-700 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider rounded-tl-lg">
                            ชื่อ-นามสกุล
                        </th>
                        @foreach($lessonStats as $l)
                            <th class="px-5 py-3 bg-gray-50 dark:bg-slate-700 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                บทที่ {{ $l->id }}
                            </th>
                        @endforeach
                        <th class="px-5 py-3 bg-gray-50 dark:bg-slate-700 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider rounded-tr-lg">
                            Final Exam
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentScores as $student)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors duration-150">
                            <td class="px-5 py-5 border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm">
                                <span class="font-medium text-gray-900">{{ $student->name }}</span>
                            </td>
                            @foreach($lessonStats as $l)
                                <td class="px-5 py-5 border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm text-center">
                                    @php
                                        // Find Post-test score for this lesson
                                        $scoreObj = isset($student->scores[$l->id]) 
                                            ? $student->scores[$l->id]->where('type', 'post')->first() 
                                            : null;
                                    @endphp
                                    @if($scoreObj)
                                        <span class="{{ $scoreObj->pass ? 'text-green-600' : 'text-red-500' }} font-bold">
                                            {{ $scoreObj->score }}
                                        </span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="px-5 py-5 border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm text-center">
                                @if($student->final_exam_score)
                                    <span class="{{ $student->final_exam_score->pass ? 'text-green-600' : 'text-red-500' }} font-bold">
                                        {{ $student->final_exam_score->score }} / {{ $student->total_questions }}
                                    </span>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if($studentScores->isEmpty())
                        <tr>
                            <td colspan="{{ count($lessonStats) + 2 }}" class="px-5 py-5 border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm text-center text-gray-500">
                                ไม่พบข้อมูลผู้เรียน
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
