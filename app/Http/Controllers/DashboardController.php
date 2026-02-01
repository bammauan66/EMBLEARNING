<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $uid = auth()->id();

        $donePre = DB::table('scores')
            ->where('user_id',$uid)
            ->where('type','pre')
            ->exists();

        $donePost = DB::table('scores')
            ->where('user_id',$uid)
            ->where('type','post')
            ->exists();

        $lessons = DB::table('lessons')->get();

        return view('dashboard', compact(
            'donePre','donePost','lessons'
        ));
    }
}
