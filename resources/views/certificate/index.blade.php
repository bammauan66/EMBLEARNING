<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Certificate of Completion | Wilcom E-Learning</title>
    @vite(['resources/css/app.css'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pinyon+Script&family=Playfair+Display:wght@400;700&display=swap');
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-5xl h-[700px] border-[20px] border-double border-green-800 relative shadow-2xl flex flex-col items-center justify-center text-center p-10 bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')]">
        
        <!-- Decoration -->
        <div class="absolute top-4 left-4 w-24 h-24 border-t-4 border-l-4 border-yellow-500"></div>
        <div class="absolute top-4 right-4 w-24 h-24 border-t-4 border-r-4 border-yellow-500"></div>
        <div class="absolute bottom-4 left-4 w-24 h-24 border-b-4 border-l-4 border-yellow-500"></div>
        <div class="absolute bottom-4 right-4 w-24 h-24 border-b-4 border-r-4 border-yellow-500"></div>

        <h1 class="text-6xl font-serif text-green-900 mb-2 font-bold uppercase tracking-widest drop-shadow-sm" style="font-family: 'Playfair Display', serif;">
            Certificate
        </h1>
        <h2 class="text-2xl text-yellow-600 uppercase tracking-[0.3em] font-semibold mb-12">
            of Completion
        </h2>

        <p class="text-xl text-gray-500 mb-4 font-serif italic">This is to certify that</p>

        <h3 class="text-5xl text-gray-900 mb-6 font-bold" style="font-family: 'Pinyon Script', cursive;">
            {{ $user->name }}
        </h3>

        <div class="w-2/3 h-0.5 bg-gray-300 mx-auto mb-6"></div>

        <p class="text-lg text-gray-600 mb-2 leading-relaxed max-w-2xl mx-auto">
            Has successfully completed the comprehensive course on
        </p>

        <h4 class="text-3xl font-bold text-green-800 mb-8" style="font-family: 'Playfair Display', serif;">
            Wilcom Embroidery Studio System
        </h4>

        <div class="flex justify-around w-full mt-12 items-end">
            <div class="text-center">
                <div class="border-b border-gray-400 w-48 mb-2"></div>
                <p class="text-sm text-gray-500 uppercase tracking-wider">Date</p>
                <p class="font-serif text-lg">{{ now()->format('d M Y') }}</p>
            </div>

            <!-- Seal -->
            <div class="w-32 h-32 bg-yellow-500 rounded-full flex items-center justify-center text-white font-bold shadow-inner relative">
                <div class="absolute inset-2 border-2 border-white rounded-full border-dashed"></div>
                <span class="transform -rotate-12 text-center text-xs leading-tight">
                    OFFICIAL<br>CERTIFIED<br>EXCELLENCE
                </span>
            </div>

            <div class="text-center">
                <div class="text-3xl font-script text-gray-800 mb-[-10px]" style="font-family: 'Pinyon Script', cursive;">Wilcom Instructor</div>
                <div class="border-b border-gray-400 w-48 mb-2"></div>
                <p class="text-sm text-gray-500 uppercase tracking-wider">Instructor Signature</p>
            </div>
        </div>

    </div>

    <div class="fixed bottom-6 right-6 flex gap-4 no-print">
        <a href="/student/dashboard" class="bg-gray-600 text-white px-6 py-3 rounded-full shadow hover:bg-gray-700">กลับหน้าหลัก</a>
        <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-3 rounded-full shadow hover:bg-blue-700 font-bold flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Print Certificate
        </button>
    </div>

</body>
</html>
