@extends('layouts.app')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-10">
    <div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-soft w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 overflow-hidden border border-gray-100 dark:border-slate-700">

        <!-- Left: Role Selection (Gradient Background) -->
        <div class="bg-gradient-to-br from-green-600 to-teal-600 p-8 sm:p-10 flex flex-col justify-center relative overflow-hidden text-white">
             <!-- Decorative Circles -->
            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white opacity-10 rounded-full blur-xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-white opacity-10 rounded-full blur-xl animate-float"></div>

            <div class="relative z-10 text-center mb-8">
                <div class="bg-white/20 backdrop-blur-md w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl border border-white/30">
                     <span class="material-icons-outlined text-white text-4xl">person_add_alt_1</span>
                </div>
                <h2 class="text-3xl font-bold text-white mb-2">
                    สร้างบัญชีใหม่
                </h2>
                <p class="text-green-50 text-opacity-90">
                    เลือกประเภทผู้ใช้งานเพื่อเริ่มต้นการเรียนรู้
                </p>
            </div>

            <div class="space-y-4 relative z-10 max-w-md mx-auto w-full">
                
                <!-- Teacher/Admin Button -->
                <button type="button" id="teacherBtn" onclick="selectRole('teacher')"
                    class="w-full p-4 rounded-xl border border-white/30 bg-white/10 backdrop-blur-sm hover:bg-white/20 transition-all duration-300 text-left group relative overflow-hidden">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-full mr-4 group-hover:bg-white/30 transition-colors">
                            <span class="text-2xl">👨‍🏫</span>
                        </div>
                        <div>
                            <div class="font-bold text-white text-lg">ผู้ดูแลระบบ (Admin)</div>
                            <div class="text-sm text-green-100 opacity-80">สำหรับบริหารจัดการระบบ</div>
                        </div>
                         <div class="ml-auto opacity-0 group-[.active]:opacity-100 text-white transform scale-0 group-[.active]:scale-100 transition-all duration-300">
                            <span class="material-icons-outlined text-2xl">check_circle</span>
                        </div>
                    </div>
                </button>

                <!-- Student Button -->
                <button type="button" id="studentBtn" onclick="selectRole('student')"
                    class="w-full p-4 rounded-xl border border-white/30 bg-white/10 backdrop-blur-sm hover:bg-white/20 transition-all duration-300 text-left group relative overflow-hidden">
                    <div class="flex items-center">
                         <div class="bg-white/20 p-3 rounded-full mr-4 group-hover:bg-white/30 transition-colors">
                            <span class="text-2xl">🎓</span>
                        </div>
                        <div>
                            <div class="font-bold text-white text-lg">ผู้เรียน (Student)</div>
                            <div class="text-sm text-green-100 opacity-80">สำหรับเข้าเรียนคอร์สต่างๆ</div>
                        </div>
                         <div class="ml-auto opacity-0 group-[.active]:opacity-100 text-white transform scale-0 group-[.active]:scale-100 transition-all duration-300">
                            <span class="material-icons-outlined text-2xl">check_circle</span>
                        </div>
                    </div>
                </button>

                 <!-- Hint -->
                <div id="roleHint" class="hidden mt-4 text-center animate-fade-in-up">
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-white text-green-700 shadow-lg">
                        <span class="material-icons-outlined text-sm mr-1">thumb_up</span> เลือกเรียบร้อยแล้ว
                    </span>
                </div>
            </div>
            
            <div class="mt-8 text-center relative z-10">
                <p class="text-sm text-green-50 opacity-80 inline">มีบัญชีอยู่แล้ว?</p>
                <a href="{{ route('login') }}" class="ml-1 text-white hover:text-green-200 font-bold underline transition-colors">เข้าสู่ระบบ</a>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="p-8 sm:p-10 flex flex-col justify-center bg-white dark:bg-slate-800">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">ลงทะเบียนสมาชิก</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">กรอกข้อมูลด้านล่างให้ครบถ้วน</p>
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-emerald-600 mt-2 transition-colors">
                     <span class="material-icons-outlined text-sm mr-1">arrow_back</span> กลับหน้าหลัก
                </a>
            </div>

            @if($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 text-red-700 dark:text-red-300 text-sm p-4 mb-6 rounded-r shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5" onsubmit="return checkRole()">
                @csrf
                <input type="hidden" name="role" id="role_input">

                <div class="group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-focus-within:text-emerald-600 transition-colors">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                            <span class="material-icons-outlined">badge</span>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full pl-10 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 outline-none placeholder-gray-400" placeholder="ระบุชื่อจริง นามสกุลจริง">
                    </div>
                </div>

                <div class="group">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-focus-within:text-emerald-600 transition-colors">อีเมล <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                            <span class="material-icons-outlined">email</span>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                             class="w-full pl-10 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 outline-none placeholder-gray-400" placeholder="example@email.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-focus-within:text-emerald-600 transition-colors">รหัสผ่าน <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                <span class="material-icons-outlined">lock</span>
                            </div>
                            <input type="password" name="password" required autocomplete="new-password"
                                 class="w-full pl-10 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 outline-none placeholder-gray-400" placeholder="8+ ตัวอักษร">
                        </div>
                    </div>
    
                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 group-focus-within:text-emerald-600 transition-colors">ยืนยันรหัสผ่าน <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                                <span class="material-icons-outlined">verified_user</span>
                            </div>
                            <input type="password" name="password_confirmation" required autocomplete="new-password"
                                 class="w-full pl-10 px-4 py-2.5 rounded-xl border border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 outline-none placeholder-gray-400" placeholder="ระบุอีกครั้ง">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2 mt-6">
                    <span>ลงทะเบียนทันที</span>
                    <span class="material-icons-outlined text-lg">arrow_forward</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function selectRole(role) {
        document.getElementById('role_input').value = role;
        
        // Reset active states
        const buttons = ['teacherBtn', 'studentBtn'];
        buttons.forEach(id => {
             const btn = document.getElementById(id);
             btn.classList.remove('active', 'bg-white/20', 'border-white', 'shadow-lg');
             btn.classList.add('bg-white/10', 'border-white/30');
        });

        // Add active state
        const activeBtn = document.getElementById(role + 'Btn');
        activeBtn.classList.add('active', 'bg-white/20', 'border-white', 'shadow-lg');
        activeBtn.classList.remove('bg-white/10', 'border-white/30');
        
        // Show hint
        const hint = document.getElementById('roleHint');
        hint.classList.remove('hidden');
    }

    function checkRole() {
        if (!document.getElementById('role_input').value) {
            // Modern Alert replacement could go here, but using alert for simplicity
            alert('กรุณาเลือกประเภทผู้ใช้งาน (Admin หรือ Student) จากเมนูด้านซ้ายก่อนครับ');
            return false;
        }
        return true;
    }
</script>
@endsection
