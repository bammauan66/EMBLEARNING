<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion - {{ $user->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: landscape;
            margin: 0;
        }
        body {
            font-family: 'Sarabun', sans-serif;
            -webkit-print-color-adjust: exact;
        }
        .cert-font {
            font-family: 'Pinyon Script', cursive;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4 print:p-0 print:bg-white">

    <div class="relative w-[1123px] h-[794px] bg-white text-center border-[20px] border-double border-[#006400] p-10 shadow-2xl print:shadow-none print:w-full print:h-full print:border-[10px] mx-auto bg-[url('https://www.transparenttextures.com/patterns/cream-paper.png')]">
        
        <!-- Decorative Corners -->
        <div class="absolute top-4 left-4 w-16 h-16 border-t-4 border-l-4 border-[#008a00]"></div>
        <div class="absolute top-4 right-4 w-16 h-16 border-t-4 border-r-4 border-[#008a00]"></div>
        <div class="absolute bottom-4 left-4 w-16 h-16 border-b-4 border-l-4 border-[#008a00]"></div>
        <div class="absolute bottom-4 right-4 w-16 h-16 border-b-4 border-r-4 border-[#008a00]"></div>

        <!-- Content -->
        <div class="h-full flex flex-col justify-center items-center border-[2px] border-[#008a00] p-10">
            
            <img src="{{ asset('img/logo_new.png') }}" alt="Wilcom Logo" class="h-20 mb-6 mx-auto">

            <h1 class="text-5xl font-bold text-[#006400] uppercase tracking-widest mb-2">Certificate of Completion</h1>
            <p class="text-xl text-gray-600 mb-8 italic">ใบประกาศนียบัตรฉบับนี้มอบให้เพื่อแสดงว่า</p>

            <h2 class="text-6xl font-bold text-gray-800 mb-6 cert-font tracking-wide">{{ $user->name }}</h2>

            <p class="text-xl text-gray-600 mb-2">ได้ผ่านการอบรมหลักสูตร</p>
            <h3 class="text-3xl font-bold text-[#008a00] mb-8">Wilcom Embroidery Studio (Basic Level)</h3>

            <p class="text-lg text-gray-500 mb-12">เมื่อวันที่ {{ now()->locale('th')->isoFormat('D MMMM YYYY') }}</p>

            <div class="flex justify-around w-full mt-10">
                <div class="text-center">
                    <div class="border-b-2 border-gray-400 w-64 mx-auto mb-2"></div>
                    <p class="font-bold text-gray-700">Course Instructor</p>
                    <p class="text-sm text-gray-500">ผู้สอนหลักสูตร</p>
                </div>
                <div class="text-center">
                    <div class="border-b-2 border-gray-400 w-64 mx-auto mb-2"></div>
                    <p class="font-bold text-gray-700">Director of Education</p>
                    <p class="text-sm text-gray-500">ผู้อำนวยการฝ่ายการศึกษา</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Print Button (Hidden in Print) -->
    <div class="fixed bottom-8 right-8 print:hidden flex space-x-4">
        <a href="/dashboard" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transition-transform transform hover:scale-105">
            กลับหน้าหลัก
        </a>
        <button onclick="window.print()" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transition-transform transform hover:scale-105 flex items-center space-x-2">
            <span class="material-icons-outlined">print</span>
            <span>พิมพ์ใบประกาศ</span>
        </button>
    </div>

</body>
</html>
