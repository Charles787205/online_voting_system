<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Watcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWatchersController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get the elections that the watcher is assigned to
        $watcher = Watcher::where('user_id', $user->id)->first();
        
        if ($watcher) {
            $election = $watcher->election;
            return view('userwatchers.index', compact('election'));
        }
        
        return redirect()->route('dashboard')->with('error', 'You are not assigned to any election.');
    }
}