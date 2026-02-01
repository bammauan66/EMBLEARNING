@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-6">
    Dashboard อาจารย์ผู้สอน
</h1>

<ul class="list-disc pl-6 text-gray-700">
    <li>ดูคะแนนนักศึกษา</li>
    <li>ติดตามผลการเรียนรู้</li>
    <li>ส่งออกข้อมูลผลการเรียน</li>
</ul>

<a href="/teacher/scores"
   class="inline-block mt-6 bg-blue-700 text-white px-4 py-2 rounded-lg">
   ดูคะแนนนักศึกษา
</a>

<a href="/teacher/export"
   class="inline-block mt-4 bg-green-700 text-white px-4 py-2 rounded-lg">
   Export คะแนน (ทำใบประกาศ)
</a>

@endsection
