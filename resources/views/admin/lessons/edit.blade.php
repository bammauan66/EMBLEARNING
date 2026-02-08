@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-green-800 leading-tight">
                แก้ไขบทเรียน: {{ $lesson->title }}
            </h2>
            <a href="{{ route('admin.lessons.index') }}" class="text-gray-600 hover:text-gray-900">
                &larr; กลับ
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">ชื่อบทเรียน:</label>
                        <input type="text" name="title" id="title" value="{{ $lesson->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">คำอธิบาย:</label>
                        <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $lesson->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="video_url" class="block text-gray-700 text-sm font-bold mb-2">Video URL:</label>
                        <input type="text" name="video_url" id="video_url" value="{{ $lesson->video_url }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="https://www.youtube.com/watch?v=... หรือ Link ไฟล์ .mp4">
                        <p class="text-sm text-gray-500 mt-1">
                            รองรับ: 
                            <span class="inline-block bg-red-100 text-red-800 px-1 rounded">YouTube Link</span>, 
                            <span class="inline-block bg-blue-100 text-blue-800 px-1 rounded">Embed Code (&lt;iframe...&gt;)</span>, 
                            <span class="inline-block bg-green-100 text-green-800 px-1 rounded">Direct File (.mp4)</span>
                        </p>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 text-sm font-bold mb-2">เนื้อหาเพิ่มเติม (ถ้ามี):</label>
                        <textarea name="content" id="content" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $lesson->content }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="attachment" class="block text-gray-700 text-sm font-bold mb-2">เอกสารประกอบ (PDF, Doc, Zip):</label>
                        @if($lesson->attachment)
                            <div class="mb-2 text-sm text-gray-600">
                                ไฟล์ปัจจุบัน: <a href="{{ asset('storage/'.$lesson->attachment) }}" target="_blank" class="text-blue-600 hover:underline">ดาวน์โหลด</a>
                            </div>
                        @endif
                        <input type="file" name="attachment" id="attachment" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <hr class="my-8 border-gray-300">

                    <!-- Questions Section -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-800">แบบทดสอบ (Quiz)</h3>
                            <button type="button" onclick="addQuestion()" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-2 px-4 rounded transition">
                                + เพิ่มคำถาม
                            </button>
                        </div>
                        <input type="hidden" name="clear_questions" value="1">
                        
                        <div id="questions_container" class="space-y-6">
                            @foreach($questions as $index => $q)
                                @php 
                                    $opts = json_decode($q->options, true); 
                                @endphp
                                <div class="p-4 border rounded-xl bg-gray-50 relative question-item">
                                    <button type="button" onclick="this.closest('.question-item').remove()" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold">
                                        &times; ลบ
                                    </button>
                                    <div class="mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-1">คำถามที่ {{ $index + 1 }}</label>
                                        <input type="text" name="questions[{{ $index }}][question]" value="{{ $q->question }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 1</label>
                                            <input type="text" name="questions[{{ $index }}][option_1]" value="{{ $opts[1] ?? '' }}" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 2</label>
                                            <input type="text" name="questions[{{ $index }}][option_2]" value="{{ $opts[2] ?? '' }}" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 3</label>
                                            <input type="text" name="questions[{{ $index }}][option_3]" value="{{ $opts[3] ?? '' }}" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 4</label>
                                            <input type="text" name="questions[{{ $index }}][option_4]" value="{{ $opts[4] ?? '' }}" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">เฉลย (ข้อที่ถูก)</label>
                                        <select name="questions[{{ $index }}][answer]" class="shadow border rounded w-full md:w-1/4 py-1 px-2 text-gray-700 text-sm">
                                            <option value="1" {{ $q->answer == 1 ? 'selected' : '' }}>ตัวเลือก 1</option>
                                            <option value="2" {{ $q->answer == 2 ? 'selected' : '' }}>ตัวเลือก 2</option>
                                            <option value="3" {{ $q->answer == 3 ? 'selected' : '' }}>ตัวเลือก 3</option>
                                            <option value="4" {{ $q->answer == 4 ? 'selected' : '' }}>ตัวเลือก 4</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <script>
                        let questionCount = {{ count($questions) }};
                        function addQuestion() {
                            const container = document.getElementById('questions_container');
                            const index = questionCount++;
                            const html = `
                                <div class="p-4 border rounded-xl bg-gray-50 relative question-item animate-fade-in-up">
                                    <button type="button" onclick="this.closest('.question-item').remove()" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold">
                                        &times; ลบ
                                    </button>
                                    <div class="mb-3">
                                        <label class="block text-gray-700 text-sm font-bold mb-1">คำถามใหม่</label>
                                        <input type="text" name="questions[${index}][question]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required placeholder="ใส่คำถามที่นี่...">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 1</label>
                                            <input type="text" name="questions[${index}][option_1]" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 2</label>
                                            <input type="text" name="questions[${index}][option_2]" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 3</label>
                                            <input type="text" name="questions[${index}][option_3]" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500">ตัวเลือก 4</label>
                                            <input type="text" name="questions[${index}][option_4]" class="shadow appearance-none border rounded w-full py-1 px-2 text-gray-700 text-sm" required>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">เฉลย (ข้อที่ถูก)</label>
                                        <select name="questions[${index}][answer]" class="shadow border rounded w-full md:w-1/4 py-1 px-2 text-gray-700 text-sm">
                                            <option value="1">ตัวเลือก 1</option>
                                            <option value="2">ตัวเลือก 2</option>
                                            <option value="3">ตัวเลือก 3</option>
                                            <option value="4">ตัวเลือก 4</option>
                                        </select>
                                    </div>
                                </div>
                            `;
                            container.insertAdjacentHTML('beforeend', html);
                        }
                    </script>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            อัปเดตบทเรียน
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
