<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Ensure User model is imported if used, otherwise use DB
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    // Dashboard Stats
    public function dashboard()
    {
        $totalUsers = DB::table('users')->where('role', 'student')->count();
        $totalLessons = DB::table('lessons')->count();

        // Calculate pass counts for each lesson (Only count Students)
        $lessonStats = DB::table('lessons')
            ->select('lessons.id', 'lessons.title', DB::raw('count(distinct scores.user_id) as passed_count'))
            ->leftJoin('scores', function($join) {
                $join->on('lessons.id', '=', 'scores.lesson_id')
                     ->where('scores.pass', '=', true)
                     ->where('scores.type', '=', 'post');
            })
            ->leftJoin('users', 'scores.user_id', '=', 'users.id') // Join users to check role
            ->where(function($query) {
                 $query->where('users.role', 'student') // Count only students
                       ->orWhereNull('scores.user_id'); // Allow lessons with 0 scores to show up
            })
            ->groupBy('lessons.id', 'lessons.title')
            ->orderBy('lessons.id')
            ->get();

        // -------------------------
        // Append Final Exam Stats
        // -------------------------
        $finalPassedCount = DB::table('final_scores')
            ->join('users', 'final_scores.user_id', '=', 'users.id')
            ->where('final_scores.pass', true)
            ->where('users.role', 'student') // Count only students
            ->distinct('final_scores.user_id')
            ->count('final_scores.user_id');

        // Create a stdClass object to mimic the lesson objects
        $finalStat = new \stdClass();
        $finalStat->id = 'Final'; // Special ID for Final Exam
        $finalStat->title = 'แบบทดสอบวัดผลสัมฤทธิ์ทางการเรียน (Final Exam)';
        $finalStat->passed_count = $finalPassedCount;
        // Percentage calculated below in transform

        $lessonStats->push($finalStat);

        $lessonStats->transform(function($item) use ($totalUsers) {
            $item->percent = $totalUsers > 0 ? ($item->passed_count / $totalUsers) * 100 : 0;
            return $item;
        });

        return view('admin.dashboard', compact('totalUsers', 'totalLessons', 'lessonStats'));
    }

    // ================= User Management =================
    public function usersIndex()
    {
        $users = DB::table('users')->orderBy('id', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function usersDestroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('scores')->where('user_id', $id)->delete(); // Clean up scores
        return back()->with('success', 'ลบผู้ใช้งานเรียบร้อยแล้ว');
    }

    public function usersCreate()
    {
        return view('admin.users.create');
    }

    public function usersStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:student,teacher',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'เพิ่มผู้ใช้งานเรียบร้อยแล้ว');
    }

    public function usersEdit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.users.edit', compact('user'));
    }

    public function usersUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|string|in:student,teacher',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);

            // Send email notification
            try {
                \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\NewPasswordMail($request->password));
                $emailSent = true;
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
                // Log error or set flag but don't fail the update
                $emailSent = false;
            }
        }

        DB::table('users')->where('id', $id)->update($data);

        $message = 'แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว';
        if (isset($emailSent) && $emailSent) {
            $message .= ' และส่งอีเมลแจ้งรหัสผ่านใหม่แล้ว';
        } elseif (isset($emailSent) && !$emailSent) {
            $message .= ' แต่ไม่สามารถส่งอีเมลได้ (ตรวจสอบการตั้งค่า Mail)';
        }

        return redirect()->route('admin.users.index')->with('success', $message);
    }

    // ================= Course Management (Resource Methods) =================
    
    // Index: List Lessons
    public function index()
    {
        $lessons = DB::table('lessons')->orderBy('id')->get();
        return view('admin.lessons.index', compact('lessons'));
    }

    // Create: Show Form
    public function create()
    {
        return view('admin.lessons.create');
    }

    // Store: Save Lesson
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip,jpg,png|max:10240', // 10MB max
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }
        
        DB::table('lessons')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'content' => $request->content,
            'attachment' => $attachmentPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.lessons.index')->with('success', 'บทเรียนถูกสร้างเรียบร้อยแล้ว');
    }

    // Edit: Show Form
    public function edit($id)
    {
        $lesson = DB::table('lessons')->where('id', $id)->first();
        $questions = DB::table('questions')->where('lesson_id', $id)->get();
        return view('admin.lessons.edit', compact('lesson', 'questions'));
    }

    // Update: Save Changes
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip,jpg,png|max:10240',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'content' => $request->content,
            'updated_at' => now(),
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        DB::table('lessons')->where('id', $id)->update($data);

        // Update Questions
        if ($request->has('questions')) {
            // Remove old questions
            DB::table('questions')->where('lesson_id', $id)->delete();

            // Insert new questions
            foreach ($request->questions as $q) {
                if (!empty($q['question'])) {
                    DB::table('questions')->insert([
                        'lesson_id' => $id,
                        'question' => $q['question'],
                        'options' => json_encode([
                            1 => $q['option_1'],
                            2 => $q['option_2'],
                            3 => $q['option_3'],
                            4 => $q['option_4']
                        ]),
                        'answer' => $q['answer'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        } elseif ($request->has('clear_questions')) {
             // Handle case where all questions are removed UI side, if we add a hidden field
             DB::table('questions')->where('lesson_id', $id)->delete();
        }


        return redirect()->route('admin.lessons.index')->with('success', 'บทเรียนและแบบทดสอบถูกแก้ไขเรียบร้อยแล้ว');
    }

    // Destroy: Delete Lesson
    public function destroy($id)
    {
        DB::table('lessons')->where('id', $id)->delete();
        return redirect()->route('admin.lessons.index')->with('success', 'บทเรียนถูกลบเรียบร้อยแล้ว');
    }
    // Lesson Statistics (Detailed)
    public function lessonStats($id)
    {
        // ==========================
        // FINAL EXAM STATS logic
        // ==========================
        if ($id === 'final') {
            $lesson = new \stdClass();
            $lesson->title = "แบบทดสอบวัดผลสัมฤทธิ์ทางการเรียน (Final Exam)";
            $lesson->id = 'final';

            $totalQuestions = 15; // Final has 15 questions

            // Check for search term
            $search = request('search');

            // Get Final Scores
            $query = DB::table('final_scores')
                ->join('users', 'final_scores.user_id', '=', 'users.id')
                ->select('final_scores.*', 'users.name as user_name', 'users.email');

            if ($search) {
                $query->where('users.name', 'like', "%{$search}%");
            }

            $allScores = $query->orderBy('final_scores.created_at', 'desc')->get();

            // Deduplicate: User can take final exam multiple times?
            // If we only want the LATEST attempt or PASS attempt?
            // Let's show Latest attempt per user.
            $scores = $allScores->unique('user_id');

            // Add 'type' attribute to match view expectation (though view might expect 'post'/'pre')
            $scores->transform(function($item) {
                $item->type = 'final';
                return $item;
            });

            return view('admin.lessons.stats', compact('lesson', 'scores', 'totalQuestions'));
        }

        // ==========================
        // NORMAL LESSON STATS logic
        // ==========================
        $lesson = DB::table('lessons')->where('id', $id)->first();
        
        if (!$lesson) {
            return back()->with('error', 'ไม่พบบทเรียน');
        }

        // Check for search term
        $search = request('search');

        // Get ALL scores for this lesson first (with user info)
        $query = DB::table('scores')
            ->join('users', 'scores.user_id', '=', 'users.id')
            ->where('scores.lesson_id', $id)
            ->select('scores.*', 'users.name as user_name', 'users.email');

        if ($search) {
            $query->where('users.name', 'like', "%{$search}%");
        }

        $allScores = $query->orderBy('scores.created_at', 'desc')->get();

        // Filter valid students (role = student) mostly, but join above handles existence.
        // Group by User ID + Type, taking the first (latest because of orderBy desc)
        $scores = $allScores->unique(function ($item) {
            return $item->user_id . '-' . $item->type;
        });

        // Determine total questions for calculation
        // Default 3 for lessons
        $totalQuestions = 3; 

        return view('admin.lessons.stats', compact('lesson', 'scores', 'totalQuestions'));
    }
}
