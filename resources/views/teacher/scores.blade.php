@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-6">
    ตารางคะแนนนักศึกษา
</h1>

<table class="w-full border border-collapse">
<thead class="bg-gray-100">
<tr>
    <th class="border px-3 py-2">ชื่อ</th>
    <th class="border px-3 py-2">บทที่</th>
    <th class="border px-3 py-2">คะแนน</th>
    <th class="border px-3 py-2">ผล</th>
</tr>
</thead>
<tbody>
@foreach($scores as $s)
<tr>
    <td class="border px-3 py-2">{{ $s->name }}</td>
    <td class="border px-3 py-2">{{ $s->lesson_id }}</td>
    <td class="border px-3 py-2">{{ $s->score }}</td>
    <td class="border px-3 py-2">
        {{ $s->pass ? 'ผ่าน' : 'ไม่ผ่าน' }}
    </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
