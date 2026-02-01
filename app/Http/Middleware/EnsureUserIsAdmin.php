<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and has teacher role (admin)
        if (Auth::check() && Auth::user()->role === 'teacher') {
            return $next($request);
        }

        // Redirect to student dashboard if student, or login if guest (though auth middleware covers guest)
        if (Auth::check() && Auth::user()->role === 'student') {
            return redirect()->route('dashboard')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงส่วนนี้');
        }

        return redirect()->route('login');
    }
}
