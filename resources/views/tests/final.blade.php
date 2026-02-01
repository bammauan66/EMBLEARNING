@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col items-center py-10 px-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-8 text-white text-center">
            <h1 class="text-3xl font-bold mb-2">🎓 แบบทดสอบประมวลผลความรู้ (Final Exam)</h1>
            <p class="text-purple-100 text-lg">แบบทดสอบรวม 5 บทเรียนเพื่อรับใบประกาศนียบัตร</p>
        </div>

        <!-- Content -->
        <div class="p-8">
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <span class="font-bold">เงื่อนไข:</span> ต้องได้คะแนนมากกว่า 60% ขึ้นไปถึงจะได้รับใบประกาศนียบัตร
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('final.submit') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    @foreach($questions as $index => $q)
                    <div class="mb-4 pb-4 border-b border-gray-100">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $index + 1 }}. {{ $q['question'] }}</h3>
                        <div class="mt-2 space-y-2">
                             @foreach($q['options'] as $key => $option)
                            <label class="flex items-center space-x-3 p-3 rounded hover:bg-gray-50 cursor-pointer">
                                <input type="radio" name="q{{ $q['id'] }}" value="{{ $key }}" class="form-radio text-purple-600" required>
                                <span class="text-gray-700">{{ $option }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 text-center">
                    <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold py-3 px-10 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                        ส่งคำตอบสุดท้าย
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
