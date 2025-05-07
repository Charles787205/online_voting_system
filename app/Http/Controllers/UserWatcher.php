<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watcher;
use App\Models\Nominee;
use App\Models\Vote;
use App\Models\Election;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserWatcher extends Controller
{
    public function index(Request $request)
    {
        $watchers = Watcher::where('user_id', Auth::id())->with(['election' => function($query) {
            $query->select('id', 'name', 'voting_start', 'voting_end', 'is_archived');
        }])->get();
        
        foreach ($watchers as $watcher) {
            $now = Carbon::now();
            $votingEnd = Carbon::parse($watcher->election->voting_end);
            $watcher->election->is_active = $now->between(Carbon::parse($watcher->election->voting_start), $votingEnd) && !$watcher->election->is_archived;
            $watcher->election->time_remaining = $watcher->election->is_active ? $votingEnd->diffForHumans(null, true) : null;
            $watcher->election->voting_end_timestamp = $votingEnd->timestamp;
        }
        
        return view('userwatchers.index', compact('watchers')); 
    }
    
    public function getVoteCounts(Request $request, $electionId)
    {
        // Get all nominees for this election
        $nominees = Nominee::whereHas('electionPosition', function($query) use ($electionId) {
            $query->where('election_id', $electionId);
        })
        ->with(['student.user', 'electionPosition.position', 'votes'])
        ->get();
        
        $results = [];
        foreach ($nominees as $nominee) {
            $results[] = [
                'id' => $nominee->id,
                'name' => $nominee->student->user->name,
                'position' => $nominee->electionPosition->position->name,
                'vote_count' => $nominee->votes->count(),
            ];
        }
        
        return response()->json($results);
    }
}
