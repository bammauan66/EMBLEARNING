<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * แสดงรายการบทเรียนทั้งหมด
     */
    public function index()
    {
        $lessons = DB::table('lessons')->get();

        return view('lessons.index', compact('lessons'));
    }

    /**
     * แสดงบทเรียนรายบท (ต้องทำ pre-test ก่อน)
     */
    public function show($id)
    {
        // ตรวจสอบว่าทำแบบทดสอบก่อนเรียนแล้วหรือยัง
        $donePre = DB::table('scores')
            ->where('user_id', Auth::id())
            ->where('type', 'pre')
            ->exists();

        if (!$donePre) {
            return redirect()->route('pretest')
                ->with('warning', 'กรุณาทำแบบทดสอบก่อนเรียนก่อนเข้าสู่บทเรียน');
        }

        // ดึงข้อมูลบทเรียน
        $lesson = DB::table('lessons')->find($id);

        if (!$lesson) {
            abort(404);
        }

        return view('lessons.show', compact('lesson'));
    }
}
