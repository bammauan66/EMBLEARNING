<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        // Truncate the table first to avoid duplicates
        DB::table('questions')->truncate();

        $questions = [
            // Lesson 1 (Q1-3)
            [
                'lesson_id' => 1,
                'question' => 'โปรแกรม willcom คือโปรแกรมใช้สำหรับทำอะไร',
                'options' => json_encode([1 => 'โปรแกรมออกแบบลายปัก', 2 => 'โปรแกรมคำนวณ', 3 => 'โปรแกรมเทียบสีไหม', 4 => 'โปรแกรมสำหรับทำ Art']),
                'answer' => 1
            ],
            [
                'lesson_id' => 1,
                'question' => 'คีย์ลัดเบื้องต้นที่ใช้สำหรับ Satin ใช้คีย์ลัดอะไร ?',
                'options' => json_encode([1 => 'F4', 2 => 'F3', 3 => 'F6', 4 => 'F8']),
                'answer' => 1
            ],
            [
                'lesson_id' => 1,
                'question' => 'งานหมวกต้องตีในรูปแบบไหน?',
                'options' => json_encode([1 => 'ตีจากซ้ายไปขวา', 2 => 'ตีจากขวาไปซ้าย', 3 => 'ตีออกจากตรงกลาง', 4 => 'ถูกทุกข้อ']),
                'answer' => 3
            ],
            // Lesson 4 (Q4-6) -- Note logic mapping from controller
            [
                'lesson_id' => 4,
                'question' => 'Text ที่มีความสูง 7-10 mm. ตั้งไกด์ที่ขนาดเท่าไร?',
                'options' => json_encode([1 => '0.30 กับ 0.10', 2 => '0.50 กับ 0.20', 3 => '0.35 กับ 0.15', 4 => 'เท่าใดก็ได้']),
                'answer' => 3
            ],
            [
                'lesson_id' => 4,
                'question' => 'ต้องวัดความสูงของ Text ก่อนตั้งไกด์หรือไม่ ?',
                'options' => json_encode([1 => 'จำเป็นต้องวัด', 2 => 'ไม่จำเป็นต้องวัด', 3 => 'ไม่ต้องวัดคาดเอาเอง', 4 => 'ตอบข้อ 2 และ 3']),
                'answer' => 1
            ],
            [
                'lesson_id' => 4,
                'question' => 'Text ที่มีความสูงเกิน 10 mm. ต้องตั้งไกด์ที่ขนาดเท่าไร ?',
                'options' => json_encode([1 => '0.50 กับ 0.20', 2 => '0.30 กับ 0.10', 3 => '0.35 กับ 0.15', 4 => 'เท่าใดก็ได้']),
                'answer' => 1
            ],
            // Lesson 2 (Q7-9)
            [
                'lesson_id' => 2,
                'question' => 'การใส่ Underlay Edge Run ควรใส่ Text ที่มีความกว้างเท่าใด',
                'options' => json_encode([1 => '0.8 มม.', 2 => '1.5 มม.', 3 => '1.8 มม.', 4 => '2.5 มม.']),
                'answer' => 3
            ],
            [
                'lesson_id' => 2,
                'question' => 'การใส่ Underlay แบบไหนขึ้นอยู่กับอะไร',
                'options' => json_encode([1 => 'ความกว้างของชิ้นงาน', 2 => 'ความสูงของชิ้นงาน', 3 => 'ใส่แบบใดก็ได้', 4 => 'ถูกทุกข้อ']),
                'answer' => 1
            ],
            [
                'lesson_id' => 2,
                'question' => 'การใส่ Underlay สำหรับหมวกที่เป็น Satin ที่มีความกว้าง 1.6 mm. ขึ้นไป ควรใส่ Underlay แบบใด',
                'options' => json_encode([1 => 'Edge Run', 2 => 'Double Zigzag', 3 => 'Center Run', 4 => 'ถูกทุกข้อ']),
                'answer' => 2
            ],
            // Lesson 3 (Q10-12)
            [
                'lesson_id' => 3,
                'question' => 'วิธีการล็อคไหมต้องใช้คีย์ลัดอะไร ?',
                'options' => json_encode([1 => 'F4', 2 => 'F3', 3 => 'F6', 4 => 'F8']),
                'answer' => 4
            ],
            [
                'lesson_id' => 3,
                'question' => 'การล็อคไหมทำคล้ายตัวอะไร ?',
                'options' => json_encode([1 => 'ตัว u', 2 => 'ตัว y', 3 => 'ตัว v', 4 => 'ตัว z']),
                'answer' => 3
            ],
            [
                'lesson_id' => 3,
                'question' => 'ระยะห่างระหว่าง text กว้างเท่าใดจึงจะต้องล็อคไหม',
                'options' => json_encode([1 => '1.2 มม. ขึ้นไป', 2 => '0.8 มม. ขึ้นไป', 3 => '1.5 มม. ขึ้นไป', 4 => 'ถูกทุกข้อ']),
                'answer' => 1
            ],
            // Lesson 5 (Q13-15)
            [
                'lesson_id' => 5,
                'question' => 'CutterBuck ต้องตัดไหม text ทุกตัวหรือไม่ ?',
                'options' => json_encode([1 => 'ตัดไหม text ทุกตัว', 2 => 'เชื่อมไหม text ทุกตัว', 3 => 'ตัดบ้างเชื่อมบ้าง', 4 => 'แล้วแต่ระยะห่างของ text']),
                'answer' => 1
            ],
            [
                'lesson_id' => 5,
                'question' => 'Acushnet ใช้ไหมตระกูลอะไร ?',
                'options' => json_encode([1 => 'Madeira Classic 40', 2 => 'Acushnet 2017', 3 => 'Isacord 40', 4 => 'Gunold poly 40']),
                'answer' => 2
            ],
            [
                'lesson_id' => 5,
                'question' => 'cgchocca ห้ามใส่ Underlay แบบใด ?',
                'options' => json_encode([1 => 'Edge Run', 2 => 'Double Zigzag', 3 => 'Center Run', 4 => 'ใส่ได้ทุก Underlay']),
                'answer' => 2
            ],
        ];

        foreach ($questions as $q) {
            DB::table('questions')->insert(array_merge($q, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
