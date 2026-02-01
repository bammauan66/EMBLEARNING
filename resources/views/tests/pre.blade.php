@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white">
            <h2 class="text-3xl font-bold mb-2">แบบทดสอบก่อนเรียน (Pre-test)</h2>
            <p class="text-blue-100 text-lg">บทที่ {{ $lesson ?? 1 }}: {{ $lessonData->title ?? 'ความรู้เบื้องต้นเกี่ยวกับ Wilcom' }}</p>
        </div>

        <!-- Instructions -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mx-8 mt-8 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <span class="font-bold">คำชี้แจง:</span> โปรดเลือกคำตอบที่ถูกต้องที่สุดเพียงข้อเดียว
                    </p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form method="POST" action="/lesson/{{ $lesson ?? 1 }}/pretest" class="p-8 space-y-8">
            @csrf
            
            <!-- Questions Loop -->
            @foreach($questions as $index => $q)
            <div class="space-y-4 mb-8">
                <h3 class="text-xl font-semibold text-black flex items-start gap-2">
                    <span class="bg-blue-100 text-blue-800 text-sm font-bold px-2.5 py-0.5 rounded mt-1">ข้อที่ {{ $index + 1 }}</span>
                    {{ $q['question'] }}
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    @foreach($q['options'] as $key => $option)
                    <label class="flex items-center p-4 border rounded-xl hover:bg-blue-50 cursor-pointer transition-colors border-gray-200">
                        <input type="radio" name="q{{ $q['id'] }}" value="{{ $key }}" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                        <span class="ml-3 text-black font-medium">{{ $option }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <hr class="border-gray-200">

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="/student/dashboard" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 rounded transition-colors hover:bg-gray-100">
                    &larr; กลับหน้าหลัก
                </a>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:ring-4 focus:ring-blue-300">
                    ส่งคำตอบ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
