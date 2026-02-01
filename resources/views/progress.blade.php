@extends('layouts.app')

@section('content')

<h1 class="text-xl font-bold mb-6">
    ความคืบหน้าการเรียนรู้
</h1>

<p class="text-gray-600 mb-8">
    แสดงความก้าวหน้าในการเรียนรู้โปรแกรม Wilcom Embroidery Studio
</p>

<!-- Progress Bar -->
<div class="mb-8">
    <div class="flex justify-between text-sm mb-1">
        <span>ความคืบหน้า</span>
        <span>{{ $passedLessons }} / {{ $totalLessons }} บท</span>
    </div>

    <div class="w-full bg-gray-200 rounded-full h-4">
        <div class="bg-green-600 h-4 rounded-full"
             style="width: {{ ($passedLessons / $totalLessons) * 100 }}%">
        </div>
    </div>
</div>

<!-- Status -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-6">

@for($i = 1; $i <= $totalLessons; $i++)
    <div class="border rounded-xl p-4 text-center
                {{ $i <= $passedLessons ? 'bg-green-50 border-green-400' : 'bg-white' }}">
        <div class="text-sm text-gray-500">
            บทที่ {{ $i }}
        </div>

        <div class="font-semibold mt-2">
            {{ $i <= $passedLessons ? 'ผ่านแล้ว' : 'ยังไม่ผ่าน' }}
        </div>
    </div>
@endfor

</div>

@endsection
