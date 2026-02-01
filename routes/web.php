<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Guest routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    
    // Login routes are now handled by auth.php
});

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        $lessons = DB::table('lessons')->orderBy('id')->get();
        // Check if user has done course pre-test
        $hasCoursePretest = DB::table('scores')
                            ->where('user_id', auth()->id())
                            ->where('lesson_id', 0)
                            ->exists();

        // Check if user passed final exam
        $hasCertificate = DB::table('final_scores')
                            ->where('user_id', auth()->id())
                            ->where('pass', true)
                            ->exists();

        // Get passed lessons IDs
        $passedLessons = DB::table('scores')
                            ->where('user_id', auth()->id())
                            ->where('pass', true)
                            ->pluck('lesson_id')
                            ->toArray();

        return view('dashboard', compact('lessons', 'hasCertificate', 'hasCoursePretest', 'passedLessons'));
    })->name('dashboard');

    // Student Dashboard
    Route::get('/student/dashboard', function () {
        $lessons = DB::table('lessons')->orderBy('id')->get();
        // Check if user has done course pre-test
        $hasCoursePretest = DB::table('scores')
                            ->where('user_id', auth()->id())
                            ->where('lesson_id', 0)
                            ->exists();

        // Check if user passed final exam
        $hasCertificate = DB::table('final_scores')
                            ->where('user_id', auth()->id())
                            ->where('pass', true)
                            ->exists();
        
        // Get passed lessons IDs
        $passedLessons = DB::table('scores')
                            ->where('user_id', auth()->id())
                            ->where('pass', true)
                            ->pluck('lesson_id')
                            ->toArray();

        return view('student.dashboard', compact('lessons', 'hasCertificate', 'hasCoursePretest', 'passedLessons'));
    })->name('student.dashboard');

    // Teacher Dashboard
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    });

    // Progress
    Route::get('/progress', [ProgressController::class, 'index'])
        ->name('progress');

    // Course Pre-test (Global)
    Route::get('/course-pretest', [TestController::class, 'coursePretest'])->name('course.pretest');
    Route::post('/course-pretest', [TestController::class, 'submitCoursePretest'])->name('course.submit_pretest');

    // Tests (Pre & Post)
    Route::get('/lesson/{lesson}/pretest', [TestController::class, 'pre'])->name('test.pre');
    Route::post('/lesson/{lesson}/pretest', [TestController::class, 'submitPre'])->name('test.submit_pre');
    
    // Lesson Video Page
    Route::get('/lesson/{id}', function ($id) {
        $lesson = DB::table('lessons')->where('id', $id)->first();
        if (!$lesson) abort(404);
        
        // Fetch all lessons for playlist
        $allLessons = DB::table('lessons')->orderBy('id')->get();
        
        // Check if user has passed final exam
        $hasCertificate = DB::table('final_scores')
                            ->where('user_id', auth()->id())
                            ->where('pass', true)
                            ->exists();

         // Check if user has done course pre-test
        $hasCoursePretest = DB::table('scores')
                            ->where('user_id', auth()->id())
                            ->where('lesson_id', 0)
                            ->exists();

        // Get passed lessons IDs
        $passedLessons = DB::table('scores')
                            ->where('user_id', auth()->id())
                            ->where('pass', true)
                            ->where('type', 'post')
                            ->pluck('lesson_id')
                            ->toArray();

        return view('lessons.show', compact('lesson', 'allLessons', 'hasCertificate', 'hasCoursePretest', 'passedLessons'));
    })->name('lesson.show');

    Route::get('/lesson/{lesson}/posttest', [TestController::class, 'post'])->name('test.post');
    Route::post('/lesson/{lesson}/posttest', [TestController::class, 'submitPost']);

    // Final Exam
    Route::get('/final-exam', [TestController::class, 'finalExam'])->name('final.exam');
    Route::post('/final-exam', [TestController::class, 'submitFinalExam'])->name('final.submit');

    // Certificate
    Route::get('/certificate', [TestController::class, 'showCertificate'])->name('certificate.show');

    // ============================================
    // Admin / Teacher Routes
    // ============================================
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        
        // Course Management
        Route::resource('lessons', \App\Http\Controllers\AdminController::class);
        Route::get('/lesson/{id}/stats', [\App\Http\Controllers\AdminController::class, 'lessonStats'])->name('lessons.stats');
        
        // User Management
        Route::get('/users', [\App\Http\Controllers\AdminController::class, 'usersIndex'])->name('users.index');
        Route::get('/users/create', [\App\Http\Controllers\AdminController::class, 'usersCreate'])->name('users.create');
        Route::post('/users', [\App\Http\Controllers\AdminController::class, 'usersStore'])->name('users.store');
        Route::get('/users/{id}/edit', [\App\Http\Controllers\AdminController::class, 'usersEdit'])->name('users.edit');
        Route::put('/users/{id}', [\App\Http\Controllers\AdminController::class, 'usersUpdate'])->name('users.update');
        Route::delete('/users/{id}', [\App\Http\Controllers\AdminController::class, 'usersDestroy'])->name('users.destroy');
        // ... (previous admin routes)
});

// Certificate Route
Route::middleware(['auth'])->group(function () {
    Route::get('/certificate', [App\Http\Controllers\CertificateController::class, 'show'])->name('certificate.show');
});

});

require __DIR__.'/auth.php';
