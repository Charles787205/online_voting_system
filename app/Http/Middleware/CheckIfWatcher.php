<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Watcher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckIfWatcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to access this resource.');
        }

        $isWatcher = Watcher::where('user_id', $user->id)->exists() || User::where('type', 'professor')->where('id', $user->id)->exists();
        
        if (!$isWatcher) {
            // Redirect based on user type
            if ($user->is_admin) {
                return redirect()->to('/elections');
            } elseif ($user->type === 'student') {
                return redirect()->to('/student/elections');
            } else {
                return redirect()->route('/');
            }
        }

        return $next($request);
    }
}