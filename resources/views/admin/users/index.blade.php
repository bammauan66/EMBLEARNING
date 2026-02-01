@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-green-800 leading-tight">
                จัดการผู้ใช้งาน (User Management)
            </h2>
            <div>
                <a href="{{ route('admin.users.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 mr-2">
                    + เพิ่มผู้ใช้งาน
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    กลับหน้า Admin
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-green-200 bg-green-50 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">
                                รหัส
                            </th>
                            <th class="px-5 py-3 border-b-2 border-green-200 bg-green-50 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">
                                ชื่อ-นามสกุล
                            </th>
                            <th class="px-5 py-3 border-b-2 border-green-200 bg-green-50 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">
                                อีเมล
                            </th>
                            <th class="px-5 py-3 border-b-2 border-green-200 bg-green-50 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">
                                สถานะ
                            </th>
                            <th class="px-5 py-3 border-b-2 border-green-200 bg-green-50 text-left text-xs font-semibold text-green-600 uppercase tracking-wider">
                                วันที่สมัคร
                            </th>
                            <th class="px-5 py-3 border-b-2 border-green-200 bg-green-50 text-right text-xs font-semibold text-green-600 uppercase tracking-wider">
                                จัดการ
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->id }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden="true" class="absolute inset-0 {{ $user->role == 'teacher' ? 'bg-green-200' : 'bg-gray-200' }} opacity-50 rounded-full"></span>
                                        <span class="relative">{{ $user->role == 'teacher' ? 'ผู้ดูแลระบบ' : 'ผู้เรียน' }}</span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->created_at }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">แก้ไข</a>
                                    
                                    <button type="button" class="text-red-600 hover:text-red-900" onclick="confirmDelete({{ $user->id }})">
                                        ลบ
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'ยืนยันการลบ?',
            text: "คุณต้องการลบผู้ใช้งานนี้ใช่หรือไม่ ข้อมูลจะกู้คืนไม่ได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        })
    }
</script>
@endsection
