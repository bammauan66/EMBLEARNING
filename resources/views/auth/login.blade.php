@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-10">
    <div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-soft w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 overflow-hidden border border-gray-100 dark:border-slate-700">

        <!-- Left: Welcome Panel -->
        <div class="bg-gradient-to-br from-green-600 to-teal-600 p-8 sm:p-10 flex flex-col justify-center relative overflow-hidden order-last md:order-first text-white">
             <!-- Decorative Circles -->
            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 bg-white opacity-10 rounded-full blur-xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 bg-white opacity-10 rounded-full blur-xl animate-float"></div>

            <div class="relative z-10 text-center">
                <div class="bg-white/20 backdrop-blur-md w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl border border-white/30">
                     <span class="material-icons-outlined text-white text-5xl">lock_open</span>
                </div>
                
                <h2 class="text-3xl font-bold text-white mb-4">
                    ยินดีต้อนรับ!
                </h2>
                <p class="text-green-50 text-opacity-90 mb-8 max-w-xs mx-auto">
                    เข้าสู่ระบบเพื่อเรียนรู้และพัฒนาทักษะของคุณต่อ
                </p>

                <div class="space-y-4">
                     <p class="text-sm text-gray-600 dark:text-gray-400">ยังไม่มีบัญชีสมาชิก?</p>
                     <a href="{{ route('register') }}" class="inline-block w-full sm:w-auto px-8 py-3 border border-white/40 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl hover:bg-white hover:text-green-600 transition-all duration-300 shadow-lg">
                        สมัครสมาชิกใหม่
                     </a>
                </div>
            </div>
        </div>

        <!-- Right: Login Form -->
        <div class="p-8 sm:p-10 flex flex-col justify-center bg-white dark:bg-slate-800">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">เข้าสู่ระบบ</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">กรอกอีเมลและรหัสผ่านเพื่อเข้าใช้งาน</p>
                <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-green-700 mt-2 transition">
                     <span class="material-icons-outlined text-sm mr-1">arrow_back</span> กลับหน้าหลัก
                </a>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-sm" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 text-red-700 dark:text-red-300 text-sm p-4 mb-6 rounded-r shadow-sm">
                    <ul class="list-disc list-inside">
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ route('login') }}" class="space-y-5" onsubmit="return checkRole()">
                @csrf
                <input type="hidden" name="role" id="role_input">

                <!-- Role Selection -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <button type="button" id="teacherBtn" onclick="selectRole('teacher')"
                        class="p-3 rounded-xl border-2 border-transparent bg-gray-50 dark:bg-slate-700 hover:border-green-500 transition-all duration-200 flex flex-col items-center justify-center group relative overflow-hidden">
                        <span class="text-2xl mb-1">👨‍🏫</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200 group-hover:text-green-700">Admin</span>
                        <div class="absolute inset-0 bg-green-100 opacity-0 group-[.active]:opacity-20 transition-opacity"></div>
                    </button>
                    
                    <button type="button" id="studentBtn" onclick="selectRole('student')"
                        class="p-3 rounded-xl border-2 border-transparent bg-gray-50 dark:bg-slate-700 hover:border-green-500 transition-all duration-200 flex flex-col items-center justify-center group relative overflow-hidden">
                        <span class="text-2xl mb-1">🎓</span>
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200 group-hover:text-green-700">Student</span>
                        <div class="absolute inset-0 bg-blue-100 opacity-0 group-[.active]:opacity-20 transition-opacity"></div>
                    </button>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">อีเมล</label>
                     <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-icons-outlined text-gray-400">email</span>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 px-4 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 outline-none" placeholder="example@email.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">รหัสผ่าน</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-icons-outlined text-gray-400">lock</span>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full pl-10 px-4 py-2 rounded-lg border border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 outline-none" placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary/50" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">จำฉันไว้ในระบบ</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm text-primary hover:text-green-700 font-medium" href="{{ route('password.request') }}">
                            ลืมรหัสผ่าน?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center space-x-2">
                    <span>เข้าสู่ระบบ</span>
                    <span class="material-icons-outlined text-sm">login</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function selectRole(role) {
        document.getElementById('role_input').value = role;
        
        // Reset active
        ['teacherBtn', 'studentBtn'].forEach(id => {
            const btn = document.getElementById(id);
            btn.classList.remove('active', 'border-green-500', 'ring-2', 'ring-green-200', 'bg-green-50');
            btn.classList.add('border-transparent', 'bg-gray-50');
        });

        // Set active
        const activeBtn = document.getElementById(role + 'Btn');
        activeBtn.classList.add('active', 'border-green-500', 'ring-2', 'ring-green-200', 'bg-green-50');
        activeBtn.classList.remove('border-transparent', 'bg-gray-50');
    }

    function checkRole() {
        if (!document.getElementById('role_input').value) {
            alert('กรุณาเลือกประเภทผู้ใช้งาน (Admin หรือ Student)');
            return false;
        }
        return true;
    }
</script>
@endsection
