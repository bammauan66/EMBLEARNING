<!-- ===== Top Navigation ===== -->
<header class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo / System Name -->
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 text-white font-bold text-sm px-3 py-1 rounded-md">
                Wilcom
            </div>
            <span class="text-gray-700 font-semibold">
                E-Learning System
            </span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex items-center space-x-3 text-sm font-medium text-gray-700">

            @if(Auth::user()->role === 'teacher')
                <a href="{{ route('admin.dashboard') }}"
                   class="px-4 py-2 rounded-md transition
                   {{ request()->routeIs('admin.*') ? 'bg-green-100 text-green-700' : 'hover:bg-green-50 hover:text-green-700' }}">
                    Admin Panel
                </a>
            @else
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-md transition
                   {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : 'hover:bg-blue-50 hover:text-blue-700' }}">
                    หน้าหลัก
                </a>

                <a href="#"
                   class="px-4 py-2 rounded-md transition hover:bg-blue-50 hover:text-blue-700 opacity-50 cursor-not-allowed" title="เร็วๆนี้">
                    ก่อนเรียน
                </a>

                <a href="#"
                   class="px-4 py-2 rounded-md transition hover:bg-blue-50 hover:text-blue-700 opacity-50 cursor-not-allowed" title="เร็วๆนี้">
                    หลังเรียน
                </a>
            @endif


            <!-- Divider -->
            <div class="h-5 w-px bg-gray-300 mx-2"></div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="px-4 py-2 rounded-md text-red-600 hover:bg-red-50 transition">
                    ออกจากระบบ
                </button>
            </form>

        </nav>
    </div>
</header>
