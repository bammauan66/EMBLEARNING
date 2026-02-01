@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white">
            <h2 class="text-3xl font-bold mb-2">แบบทดสอบหลังเรียน (Post-test)</h2>
            <p class="text-blue-100 text-lg">บทที่ {{ $lesson ?? 1 }}: {{ $lessonData->title ?? 'วัดผลการเรียนรู้' }}</p>
        </div>

        <!-- Instructions -->
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mx-8 mt-8 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">
                        <span class="font-bold">คำชี้แจง:</span> ตอบถูก 60% ขึ้นไปเพื่อผ่านไปยังบทถัดไป
                    </p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form method="POST" action="/lesson/{{ $lesson ?? 1 }}/posttest" class="p-8 space-y-8">
            @csrf
            
            <!-- Questions Loop -->
            @foreach($questions as $index => $q)
            <div class="space-y-4 mb-8">
                <h3 class="text-xl font-semibold text-gray-800 flex items-start gap-2">
                    <span class="bg-blue-100 text-blue-800 text-sm font-bold px-2.5 py-0.5 rounded mt-1">ข้อที่ {{ $index + 1 }}</span>
                    {{ $q['question'] }}
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    @foreach($q['options'] as $key => $option)
                    <label class="flex items-center p-4 border rounded-xl hover:bg-blue-50 cursor-pointer transition-colors border-gray-200">
                        <input type="radio" name="q{{ $q['id'] }}" value="{{ $key }}" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                        <span class="ml-3 text-gray-700 font-medium">{{ $option }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <hr class="border-gray-200">

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="/lesson/{{ $lesson ?? 1 }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 rounded transition-colors hover:bg-gray-100">
                    &larr; กลับไปทบทวน
                </a>
                <button type="submit" class="bg-gradient-to-r from-green-600 to-teal-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:ring-4 focus:ring-green-300">
                    ส่งคำตอบและไปต่อ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
