<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watcher;
use Carbon\Carbon;

class CheckIfStudentAndNotWatcher
{
    /**
     * Handle an incoming request.
     * Check if user is a student but not a watcher.
     * If user is a watcher, check if the associated election is active or has ended.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and is a student
        if (!Auth::check() || Auth::user()->type !== 'student') {
            return redirect('/')->with('error', 'Access restricted to students only.');
        }

        // Check if the user is a watcher
        $watcher = Watcher::where('user_id', Auth::id())->first();

        if ($watcher) {
            // User is a watcher, check if the election is active or has ended
            $election = $watcher->election;
            $now = Carbon::now();

            // If election is active or has ended (after election_end), deny access
            if ($election && ($election->is_archived == false && $now <= Carbon::parse($election->election_end))) {
                return redirect('/')->with('error', 'As a watcher, you cannot access this feature while your election is active.');
            }
        }

        // If user is a student and not a watcher, or the watcher's election has ended, allow access
        return $next($request);
    }
}