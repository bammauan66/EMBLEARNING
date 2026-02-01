@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white text-center">
            <h1 class="text-3xl font-bold">แบบทดสอบก่อนเรียน (Course Pre-test)</h1>
            <p class="mt-2 opacity-90">วัดระดับความรู้พื้นฐานก่อนเข้าสู่บทเรียน</p>
        </div>
        
        <div class="p-8">
            <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 mb-8">
                <p>แบบทดสอบนี้จัดทำขึ้นเพื่อวัดระดับความรู้พื้นฐานของคุณเกี่ยวกับโปรแกรม Wilcom Embroidery Studio ก่อนที่จะเริ่มเรียนในบทที่ 1</p>
                <p>ผลคะแนนจากการสอบครั้งนี้จะไม่มีผลต่อการผ่าน/ไม่ผ่านหลักสูตร แต่จะช่วยประเมินพัฒนาการของคุณเมื่อเรียนจบ</p>
            </div>

            <form action="{{ route('course.submit_pretest') }}" method="POST">
                @csrf
                
                <!-- Questions Loop -->
                @foreach($questions as $index => $q)
                <div class="mb-6 border-b border-gray-100 dark:border-gray-700 pb-6">
                    <p class="font-semibold text-lg mb-3 text-gray-900 dark:text-gray-100">{{ $index + 1 }}. {{ $q['question'] }}</p>
                    <div class="space-y-2">
                        @foreach($q['options'] as $key => $option)
                        <label class="flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition">
                            <input type="radio" name="q{{ $q['id'] }}" value="{{ $key }}" class="form-radio text-primary h-5 w-5" required>
                            <span class="text-gray-900 dark:text-gray-200">{{ $option }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <div class="mt-8 flex justify-center">
                    <button type="submit" class="bg-primary hover:bg-green-700 text-white font-bold py-3 px-10 rounded-full shadow-lg transform hover:-translate-y-1 transition duration-200">
                        ส่งคำตอบ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
