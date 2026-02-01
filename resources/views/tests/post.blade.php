@extends('layouts.app')

@section('content')

<h2 class="text-xl font-semibold mb-6">
    แบบทดสอบหลังเรียน
</h2>

<form method="POST" action="/posttest" class="space-y-6">
    @csrf
    <!-- คำถาม -->
</form>

@endsection
