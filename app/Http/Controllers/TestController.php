<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    private function getQuestions()
    {
        return DB::table('questions')->get()->map(function ($q) {
            return [
                'id' => $q->id,
                'question' => $q->question,
                'options' => json_decode($q->options, true),
                'answer' => $q->answer,
                'lesson_id' => $q->lesson_id
            ];
        })->toArray();
    }

    private function getQuestionsByLesson($lessonId)
    {
        return DB::table('questions')
            ->where('lesson_id', $lessonId)
            ->get()
            ->map(function ($q) {
                return [
                    'id' => $q->id,
                    'question' => $q->question,
                    'options' => json_decode($q->options, true),
                    'answer' => $q->answer
                ];
            })->toArray();
    }

    private function hasPassedCourse()
    {
        return DB::table('final_scores')
            ->where('user_id', auth()->id())
            ->where('pass', true)
            ->exists();
    }

    private function hasTakenTest($lesson, $type)
    {
         return DB::table('scores')
            ->where('user_id', auth()->id())
            ->where('lesson_id', $lesson)
            ->where('type', $type)
            ->exists();
    }

    /* ================= Pretest Page (Lesson) ================= */
    public function pre($lesson)
    {
        // Bypass removed to allow testing
        // if (auth()->check() && auth()->user()->role === 'teacher') {
        //     return redirect()->route('lesson.show', $lesson);
        // }

        // 1. Check if course passed -> View only (Redirect to lesson content)
        if ($this->hasPassedCourse()) {
            return redirect()->route('lesson.show', $lesson)->with('info', 'คุณผ่านหลักสูตรแล้ว สามารถทบทวนเนื้อหาได้เท่านั้น');
        }

        // 2. Check if already taken -> Redirect to lesson content
        if ($this->hasTakenTest($lesson, 'pre')) {
             return redirect()->route('lesson.show', $lesson)->with('info', 'คุณทำแบบทดสอบก่อนเรียนไปแล้ว');
        }

        $questions = $this->getQuestionsByLesson($lesson);
        $lessonData = DB::table('lessons')->where('id', $lesson)->first();
        return view('tests.pre', compact('lesson', 'lessonData', 'questions'));
    }

    public function submitPre(Request $request, $lesson)
    {
        // บันทึกคะแนน Pre-test แบบไม่ซีเรียส (เก็บไว้ดูพัฒนาการ)
        $questions = $this->getQuestionsByLesson($lesson);
        
        $score = 0;
        foreach ($questions as $q) {
            $userAns = $request->input('q' . $q['id']);
            if ($userAns == $q['answer']) {
                $score++;
            }
        }
        
        $count = count($questions);

        DB::table('scores')->insert([
            'user_id'   => auth()->id(),
            'lesson_id' => $lesson,
            'type'      => 'pre',
            'score'     => $score,
            'pass'      => true, // Pre-test ให้ผ่านเสมอเพื่อไปเรียนต่อ
            'created_at'=> now(),
        ]);

        return redirect()->route('lesson.show', $lesson)->with('success', "บันทึกผลทดสอบเรียบร้อยแล้ว เริ่มเรียนได้เลย");
    }

    /* ================= Posttest Page (Lesson) ================= */
    public function post($lesson)
    {
        // 1. Check if course passed -> View only
        if ($this->hasPassedCourse()) {
            return redirect()->route('lesson.show', $lesson)->with('info', 'คุณผ่านหลักสูตรแล้ว สามารถทบทวนเนื้อหาได้เท่านั้น');
        }

        // 2. Check if already taken -> Redirect to Dashboard (or next step)
        if ($this->hasTakenTest($lesson, 'post')) {
             return redirect()->route('dashboard')->with('info', 'คุณทำแบบทดสอบหลังเรียนบทนี้ไปแล้ว');
        }

        $questions = $this->getQuestionsByLesson($lesson);
        $lessonData = DB::table('lessons')->where('id', $lesson)->first();
        return view('tests.posttest', compact('lesson', 'lessonData', 'questions'));
    }

    /* ================= Submit Posttest ================= */
    public function submitPost(Request $request, $lesson)
    {
        $questions = $this->getQuestionsByLesson($lesson);

        $score = 0;
        foreach ($questions as $q) {
            $userAns = $request->input('q' . $q['id']);
            if ($userAns == $q['answer']) {
                $score++;
            }
        }

        // Pass Score: > 60%
        $total = count($questions);
        $passScore = 0;
        if ($total > 0) {
            $passScore = ceil($total * 0.6); // 60% criterion
        } else {
            // If no questions, auto-pass? or block?
            // Let's assume auto-pass for empty chapters to avoid getting stuck
            $passScore = 0; 
        }
        
        $pass = $score >= $passScore;

        // Save score
        DB::table('scores')->insert([
            'user_id'   => auth()->id(),
            'lesson_id' => $lesson,
            'type'      => 'post',
            'score'     => $score,
            'pass'      => $pass,
            'created_at'=> now(),
        ]);

        // ❌ ไม่ผ่าน → กลับไป Pretest บทเดิม (หรือจะให้เรียนใหม่ก็ได้)
        if (!$pass) {
            return redirect("/lesson/$lesson")
                ->with('error', "คุณได้ $score/$total คะแนน ยังไม่ผ่านเกณฑ์ ($passScore คะแนน)");
        }

        // ✅ ผ่าน
        if ($lesson == 5) {
            return redirect()->route('dashboard')
                ->with('success', "ยินดีด้วย! คุณผ่านบทที่ $lesson ($score/$total คะแนน) และเรียนจบหลักสูตรแล้ว เตรียมตัวทำแบบทดสอบรวม")
                ->with('unlocked_final', true);
        }

        // ไปหน้า Dashboard พร้อมปลดล็อคบทถัดไป
        return redirect()->route('dashboard')
            ->with('success', "เยี่ยมมาก! ผ่านบทที่ $lesson แล้ว ($score/$total คะแนน)")
            ->with('unlocked_lesson', $lesson + 1);
    }

    /* ================= Final Exam ================= */
    public function finalExam()
    {
        if ($this->hasPassedCourse()) {
             return redirect()->route('certificate.show')->with('info', 'คุณสอบผ่านแล้ว ไม่จำเป็นต้องสอบซ้ำ');
        }

        $questions = $this->getQuestions();
        return view('tests.final', compact('questions'));
    }

    public function submitFinalExam(Request $request)
    {
        $questions = $this->getQuestions();
        $score = 0;
        $total = count($questions);

        foreach ($questions as $q) {
            $userAns = $request->input('q' . $q['id']);
            if ($userAns == $q['answer']) {
                $score++;
            }
        }

        // Pass criterion: 60%
        $passScore = ceil($total * 0.6); 
        $pass = $score >= $passScore;

        DB::table('final_scores')->insert([
            'user_id' => auth()->id(),
            'score'   => $score,
            'pass'    => $pass,
            'created_at' => now(),
        ]);

        if ($pass) {
            return redirect()->route('certificate.show')->with('success', "ยินดีด้วย! คุณสอบผ่าน ($score/$total คะแนน)");
        }

        return back()->with('error', "คุณสอบได้ $score/$total คะแนน ยังไม่ผ่านเกณฑ์ ($passScore คะแนน) กรุณาลองใหม่อีกครั้ง");
    }

    /* ================= Certificate ================= */
    public function showCertificate()
    {
        // เช็คว่าผ่าน Final หรือยัง
        $final = DB::table('final_scores')
                    ->where('user_id', auth()->id())
                    ->where('pass', true)
                    ->latest()
                    ->first();

        if (!$final) {
            return redirect()->route('final.exam')->with('error', 'กรุณาทำแบบทดสอบให้ผ่านก่อน');
        }

        return view('certificate.index', ['user' => auth()->user()]);
    }
    /* ================= Course Global Pre-test ================= */
    public function coursePretest()
    {
        $questions = $this->getQuestions();
        return view('tests.course_pre', compact('questions'));
    }

    public function submitCoursePretest(Request $request)
    {
        $questions = $this->getQuestions();
        $score = 0;
        foreach ($questions as $q) {
            $userAns = $request->input('q' . $q['id']);
            if ($userAns == $q['answer']) {
                $score++;
            }
        }

        DB::table('scores')->insert([
            'user_id'   => auth()->id(),
            'lesson_id' => 0, // 0 = Course Pre-test
            'type'      => 'pre',
            'score'     => $score,
            'pass'      => false, // pre-test ไม่ต้องผ่าน
            'created_at'=> now(),
        ]);

        return redirect()->route('dashboard')->with('success', "บันทึกผลทดสอบก่อนเรียน ($score/" . count($questions) . " คะแนน) เรียบร้อยแล้ว เริ่มเรียนบทที่ 1 ได้เลย");
    }
}
