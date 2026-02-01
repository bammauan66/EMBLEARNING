<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Lesson;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ดึงบทเรียนทั้งหมด
        $lessons = Lesson::orderBy('order')->get();

        // ดึงบทที่ผ่านแล้ว (posttest ผ่าน)
        $passedLessons = DB::table('scores')
            ->where('user_id', $user->id)
            ->where('type', 'post')
            ->where('pass', true)
            ->pluck('lesson_id')
            ->toArray();

        // Check if Admin/Teacher
        if ($user->role === 'teacher') {
            $totalUsers = DB::table('users')->where('role', 'student')->count();

            $lessonStats = DB::table('lessons')->orderBy('id')->get()->map(function ($lesson) use ($totalUsers) {
                $passCount = DB::table('scores')
                    ->where('lesson_id', $lesson->id)
                    ->where('pass', true)
                    ->distinct('user_id')
                    ->count('user_id');
                
                $percent = $totalUsers > 0 ? ($passCount / $totalUsers) * 100 : 0;

                return (object) [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'passed_count' => $passCount,
                    'percent' => $percent
                ];
            });

            $search = request('search');
            $studentScores = DB::table('users')
                ->where('role', 'student')
                ->when($search, function($query, $search) {
                    return $query->where('name', 'like', "%{$search}%");
                })
                ->select('users.id', 'users.name')
                ->get()
                ->map(function($student) {
                    $scores = DB::table('scores')
                        ->where('user_id', $student->id)
                        ->get()
                        ->groupBy('lesson_id');
                    
                    $finalScore = DB::table('final_scores')
                        ->where('user_id', $student->id)
                        ->orderBy('score', 'desc') // Best score
                        ->first();

                    $totalQuestions = DB::table('questions')->count();

                    $student->scores = $scores;
                    $student->passed_course = $finalScore && $finalScore->pass;
                    $student->final_exam_score = $finalScore;
                    $student->total_questions = $totalQuestions;
                    return $student;
                });

            return view('progress.admin', compact('lessonStats', 'studentScores'));
        }

        return view('progress.index', compact(
            'lessons',
            'passedLessons'
        ));
    }
}
