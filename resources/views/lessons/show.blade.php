@extends('layouts.app')

@section('content')
@php
    $videoUrl = $lesson->video_url;
    $isVideoFile = false;

    // 1. Check if user pasted a raw <iframe> code
    if (preg_match('/<iframe.*?src=["\'](.*?)["\']/', $videoUrl, $matches)) {
        $videoUrl = $matches[1];
    }

    // 2. Check if it is a direct video file (mp4, webm, ogg)
    if (preg_match('/\.(mp4|webm|ogg)$/i', $videoUrl)) {
        $isVideoFile = true;
    } 
    // 3. YouTube Handling (Convert Watch URL to Embed URL if not already)
    elseif (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $videoUrl, $matches)) {
        $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
    }
@endphp

<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto space-y-6">
        
        <!-- Breadcrumb & Header -->
        <!-- Banner Section -->
        <div class="bg-gradient-to-r from-green-900 to-green-600 rounded-2xl shadow-xl overflow-hidden relative mb-8">
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 p-8 md:p-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div class="text-white">
                    <a href="/dashboard" class="inline-flex items-center text-green-100 hover:text-white mb-4 transition text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        กลับหน้าแดชบอร์ด
                    </a>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 text-shadow-sm">บทที่ {{ $lesson->id }}: {{ $lesson->title }}</h1>
                    <p class="text-green-100 text-lg opacity-90">{{ $lesson->description }}</p>
                </div>
                
                
                @if($hasCertificate ?? false)
                    <a href="/dashboard" class="bg-white text-green-800 px-6 py-3 rounded-xl shadow-lg hover:bg-green-50 hover:shadow-xl transition font-bold flex items-center transform hover:-translate-y-1">
                        <span>กลับสู่หน้าหลัก</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                @else
                    <a href="{{ route('test.post', $lesson->id) }}" class="bg-white text-green-800 px-6 py-3 rounded-xl shadow-lg hover:bg-green-50 hover:shadow-xl transition font-bold flex items-center transform hover:-translate-y-1">
                        <span>ทำแบบทดสอบหลังเรียน</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Video Player Section (Left - 2 Cols) -->
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-black rounded-xl shadow-lg overflow-hidden aspect-video relative group flex items-center justify-center">
                    @if($isVideoFile)
                        <video controls class="w-full h-full" controlsList="nodownload">
                            <source src="{{ $videoUrl }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @elseif($videoUrl)
                        <iframe 
                            class="w-full h-full"
                            src="{{ $videoUrl }}" 
                            title="Lesson Video" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    @else
                        <div class="text-white text-center p-10">
                            <p class="text-lg">ไม่พบวิดีโอสำหรับบทเรียนนี้</p>
                        </div>
                    @endif
                </div>

                <!-- Content & Attachment -->
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    @if($lesson->attachment)
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">เอกสารประกอบการเรียน</h3>
                        <div class="space-y-3 mb-6">
                            <a href="{{ asset('storage/'.$lesson->attachment) }}" target="_blank" class="flex items-center p-3 border rounded-lg hover:bg-blue-50 transition border-gray-200">
                                <div class="w-10 h-10 bg-red-100 text-red-600 rounded flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">ดาวน์โหลดเอกสารประกอบ</p>
                                    <p class="text-xs text-gray-500">คลิกเพื่อเปิดหรือบันทึก</p>
                                </div>
                                <div class="ml-auto text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                </div>
                            </a>
                        </div>
                    @endif

                    @if($lesson->content)
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">เนื้อหาเพิ่มเติม</h3>
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($lesson->content)) !!}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Playlist / Course Content (Right - 1 Col) -->
            <!-- Playlist / Course Content (Right - 1 Col) -->
            <div class="bg-white rounded-2xl shadow-soft p-6 h-fit border border-gray-100">
                <h3 class="text-lg font-bold mb-6 text-gray-800 flex items-center">
                    <span class="material-icons-outlined mr-2 text-green-600">playlist_play</span>
                    เนื้อหาในหลักสูตร
                </h3>
                <div class="space-y-3">
                    @php
                            $previousLessonPassed = $hasCoursePretest ?? false;
                        @endphp
                        @foreach($allLessons as $l)
                        @php
                            $isLocked = true;
                            if (($hasCertificate ?? false)) {
                                $isLocked = false;
                            } else {
                                $isLocked = !$previousLessonPassed;
                            }
                            
                            $currentLessonPassed = in_array($l->id, $passedLessons ?? []);
                            $isActive = $l->id == $lesson->id;
                            $isPassed = $currentLessonPassed;
                        @endphp

                        @if($isLocked)
                             <div class="group relative block p-4 rounded-xl border-2 border-transparent bg-gray-50 text-gray-400 cursor-not-allowed">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                         <span class="material-icons-outlined text-gray-300">lock</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm">บทที่ {{ $l->id }}: {{ $l->title }}</p>
                                        <p class="text-xs mt-1">
                                            @if($l->id == 1)
                                                ต้องทำแบบทดสอบก่อนเรียน
                                            @else
                                                ต้องเรียนจบบทก่อนหน้า
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('lesson.show', $l->id) }}" class="group relative block p-4 rounded-xl border-2 transition-all duration-200 {{ $isActive ? 'border-green-500 bg-green-50 shadow-md' : 'border-transparent bg-white hover:border-green-200 hover:shadow-md hover:-translate-y-0.5' }}">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        @if($isActive)
                                            <span class="material-icons-outlined text-green-600 animate-pulse">play_circle</span>
                                        @elseif($isPassed)
                                            <span class="material-icons-outlined text-green-500">check_circle</span>
                                        @else
                                             <span class="material-icons-outlined text-gray-400 group-hover:text-green-500 transition-colors">play_arrow</span>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-semibold text-sm {{ $isActive ? 'text-green-800' : 'text-gray-700 group-hover:text-green-700' }}">
                                            บทที่ {{ $l->id }}: {{ $l->title }}
                                        </p>
                                        <p class="text-xs mt-1 {{ $isActive ? 'text-green-600' : 'text-gray-500' }}">
                                            @if($isActive) กำลังรับชม @elseif($isPassed) เรียนจบแล้ว @else วิดีโอ @endif
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @php
                             $previousLessonPassed = $currentLessonPassed;
                        @endphp
                    @endforeach
                    
                    <!-- Final Exam Item -->
                    @php
                        $finalLocked = true;
                        // Build list of only passed Post-Tests (which $passedLessons is)
                        // Unlock if Certified OR (Passed Count >= Total Lessons)
                        if (($hasCertificate ?? false) || count($passedLessons ?? []) >= count($allLessons)) {
                            $finalLocked = false;
                        }
                    @endphp
                    
                     @if($finalLocked)
                        <div class="group relative block p-4 rounded-xl border-2 border-transparent bg-gray-50 text-gray-400 cursor-not-allowed mt-4">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 mt-1">
                                     <span class="material-icons-outlined text-gray-300">lock</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm">Final Exam</p>
                                    <p class="text-xs mt-1">ต้องเรียนจบทุกบท</p>
                                </div>
                            </div>
                        </div>
                    @else
                         <a href="{{ route('final.exam') }}" class="group relative block p-4 rounded-xl border-2 border-transparent bg-purple-50 hover:bg-purple-100 hover:border-purple-200 hover:shadow-md transition-all duration-200 mt-4">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 mt-1">
                                     <span class="material-icons-outlined text-purple-600">edit_document</span>
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-purple-800">Final Exam</p>
                                    <p class="text-xs text-purple-600 mt-1">แบบทดสอบหลังเรียน</p>
                                </div>
                            </div>
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
