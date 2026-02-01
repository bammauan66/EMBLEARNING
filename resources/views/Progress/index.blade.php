@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-6">ความคืบหน้าในการเรียน</h1>

@php
    $total = count($lessons);
    $passed = count($passedLessons);
    $percent = $total > 0 ? ($passed / $total) * 100 : 0;
@endphp

<!-- Progress bar รวม -->
<div class="mb-8">
    <div class="flex justify-between text-sm mb-1">
        <span>ความคืบหน้าโดยรวม</span>
        <span>{{ $passed }} / {{ $total }} บท</span>
    </div>

    <div class="w-full bg-gray-200 rounded-full h-3">
        <div class="bg-green-600 h-3 rounded-full"
             style="width: {{ $percent }}%">
        </div>
    </div>
</div>

<!-- Progress รายบท -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-4">
@foreach($lessons as $lesson)
    @php
        $isPassed = in_array($lesson->id, $passedLessons);
    @endphp

    <div class="border rounded-xl p-4 text-center
        {{ $isPassed ? 'bg-green-50 border-green-500' : 'bg-white' }}">

        <div class="text-sm text-gray-500">
            บทที่ {{ $lesson->order }}
        </div>

        <div class="font-semibold mt-1">
            {{ $lesson->title }}
        </div>

        <!-- progress ต่อบท -->
        <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
            <div class="h-2 rounded-full
                {{ $isPassed ? 'bg-green-600 w-full' : 'bg-gray-400 w-1/4' }}">
            </div>
        </div>

        <div class="text-sm mt-2
            {{ $isPassed ? 'text-green-600' : 'text-gray-400' }}">
            {{ $isPassed ? '✔ ผ่านแล้ว' : 'ยังไม่ผ่าน' }}
        </div>
    </div>
@endforeach
</div>

@endsection
