<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // Check if user passed the Final Exam (Lesson ID usually > last lesson, or specific logic)
        // Assuming Final Exam is tracked in 'final_scores' table or 'scores' table with specific ID
        // Based on file list, existing 'final_scores' table exists!
        
        $passed = DB::table('final_scores')
                    ->where('user_id', $user->id)
                    ->where('pass', 1)
                    ->exists();

        // Also fallback check: if they have 'user_role' = teacher, let them see it for testing
        if ($user->role === 'teacher') {
            $passed = true;
        }

        if (!$passed) {
             return redirect()->route('dashboard')->with('error', 'คุณยังไม่ผ่านการทดสอบ Final Exam');
        }

        return view('certificate.show', compact('user'));
    }
}
