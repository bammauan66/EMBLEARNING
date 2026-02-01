<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use Schema facade which handles SQLite/MySQL differences automatically
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        DB::table('lessons')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $lessons = [
            [
                'id' => 1,
                'title' => 'บทที่ 1: การตีตัวอักษรและไดเร็กชัน', // User provided title
                'description' => 'เรียนรู้วิธีการสร้างตัวอักษรและการกำหนดทิศทางของไหมปัก',
                'video_url' => 'https://www.youtube.com/embed/placeholder1',
            ],
            [
                'id' => 2,
                'title' => 'บทที่ 2: Underlay ของไหม',
                'description' => 'ทำความเข้าใจเกี่ยวกับการรองพื้น (Underlay) เพื่อให้ลายปักสวยงามและคงทน',
                'video_url' => 'https://www.youtube.com/embed/placeholder2',
            ],
            [
                'id' => 3,
                'title' => 'บทที่ 3: การตัดไหม',
                'description' => 'เทคนิคการตั้งค่าและการจัดการการตัดไหมให้มีประสิทธิภาพ',
                'video_url' => 'https://www.youtube.com/embed/placeholder3',
            ],
            [
                'id' => 4,
                'title' => 'บทที่ 4: การตั้งไกด์ตัวอักษร',
                'description' => 'วิธีการตั้งค่าไกด์ไลน์ (Guide) เพื่อจัดวางตำแหน่งตัวอักษรให้แม่นยำ',
                'video_url' => 'https://www.youtube.com/embed/placeholder4',
            ],
            [
                'id' => 5,
                'title' => 'บทที่ 5: คำสั่งของลูกค้าสำคัญเบื้องต้น', // Updated to match user input exactly
                'description' => 'เรียนรู้คำสั่งสำคัญต่างๆ ที่ลูกค้ามักต้องการในการปักงานจริง',
                'video_url' => 'https://www.youtube.com/embed/placeholder5',
            ],
        ];

        // Insert data using DB facade to avoid Model timestamp issues if not set up
        DB::table('lessons')->insert($lessons);
    }
}
