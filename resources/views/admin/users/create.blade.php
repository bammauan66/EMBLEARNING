@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 dark:bg-slate-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white tracking-tight">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 to-teal-500">
                        สร้างผู้ใช้งานใหม่
                    </span>
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1">เพิ่มสมาชิกใหม่เข้าสู่ระบบ Wilcom E-Learning</p>
            </div>
            
            <a href="{{ route('admin.users.index') }}" 
               class="group inline-flex items-center px-5 py-2.5 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium shadow-sm hover:shadow-md transition-all duration-300">
                <span class="material-icons-outlined text-lg mr-2 group-hover:-translate-x-1 transition-transform">arrow_back</span>
                ย้อนกลับ
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden border border-gray-100 dark:border-slate-700 relative">
            
            <!-- Decorative Top Gradient -->
            <div class="h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"></div>

            <div class="p-8 sm:p-10">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Left Column: Personal Info -->
                        <div class="space-y-6">
                            <h3 class="flex items-center text-lg font-semibold text-gray-800 dark:text-white border-b border-gray-100 dark:border-slate-700 pb-2">
                                <span class="material-icons-outlined text-emerald-500 mr-2">person</span>
                                ข้อมูลส่วนตัว
                            </h3>

                            <!-- Name -->
                            <div class="group">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-emerald-600 transition-colors">
                                    ชื่อ - นามสกุล <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                        <span class="material-icons-outlined">badge</span>
                                    </div>
                                    <input type="text" name="name" id="name" required
                                        class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300"
                                        placeholder="ระบุชื่อและนามสกุล">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="group">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-emerald-600 transition-colors">
                                    อีเมล <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                        <span class="material-icons-outlined">email</span>
                                    </div>
                                    <input type="email" name="email" id="email" required
                                        class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300"
                                        placeholder="example@wilcom.com">
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="group">
                                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-emerald-600 transition-colors">
                                    บทบาท <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                        <span class="material-icons-outlined">admin_panel_settings</span>
                                    </div>
                                    <select name="role" id="role"
                                        class="block w-full pl-10 pr-10 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 appearance-none cursor-pointer">
                                        <option value="student">ผู้เรียน (Student)</option>
                                        <option value="teacher">ผู้ดูแลระบบ (Admin/Teacher)</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                        <span class="material-icons-outlined">expand_more</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Security -->
                        <div class="space-y-6">
                            <h3 class="flex items-center text-lg font-semibold text-gray-800 dark:text-white border-b border-gray-100 dark:border-slate-700 pb-2">
                                <span class="material-icons-outlined text-emerald-500 mr-2">lock</span>
                                ความปลอดภัย
                            </h3>

                            <!-- Password -->
                            <div class="group">
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-emerald-600 transition-colors">
                                    รหัสผ่าน <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                        <span class="material-icons-outlined">lock</span>
                                    </div>
                                    <input type="password" name="password" id="password" required
                                        class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300"
                                        placeholder="••••••••">
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="group">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-emerald-600 transition-colors">
                                    ยืนยันรหัสผ่าน <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                        <span class="material-icons-outlined">verified_user</span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="block w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300"
                                        placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-8 flex items-center justify-end space-x-4 border-t border-gray-100 dark:border-slate-700 mt-8">
                        <button type="reset" class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 dark:text-gray-400 bg-white dark:bg-slate-800 hover:bg-gray-50 hover:text-red-500 transition-colors duration-300 font-medium text-sm flex items-center">
                            <span class="material-icons-outlined text-lg mr-1">refresh</span>
                            ล้างค่า
                        </button>
                        <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-sm shadow-lg hover:shadow-emerald-500/30 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center">
                            <span class="material-icons-outlined text-lg mr-2">save</span>
                            บันทึกผู้ใช้งาน
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
