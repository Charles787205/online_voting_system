<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watcher;
use App\Models\Nominee;
use App\Models\Vote;
use App\Models\Election;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserWatchersController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        
        // If user is a professor, get all elections that are not archived
        if ($user->type === 'professor') {
            $elections = Election::select('id', 'name', 'voting_start', 'voting_end', 'is_archived')
                ->where('is_archived', false)
                ->get();
                
            $watcherElections = collect();
            
            foreach ($elections as $election) {
                $votingEnd = Carbon::parse($election->voting_end);
                $election->is_active = $now->between(Carbon::parse($election->voting_start), $votingEnd);
                $election->time_remaining = $election->is_active ? $votingEnd->diffForHumans(null, true) : null;
                $election->voting_end_timestamp = $votingEnd->timestamp;
                
                // Create a custom object similar to a watcher but for all elections
                $watcherObj = new \stdClass();
                $watcherObj->election = $election;
                $watcherElections->push($watcherObj);
            }
            
            $watchers = $watcherElections;
        } else {
            // For non-professors, only show elections they are watchers for that are not archived
            $watchers = Watcher::where('user_id', $user->id)
                ->whereHas('election', function($query) {
                    $query->where('is_archived', false);
                })
                ->with(['election' => function($query) {
                    $query->select('id', 'name', 'voting_start', 'voting_end', 'is_archived');
                }])
                ->get();
            
            foreach ($watchers as $watcher) {
                $votingEnd = Carbon::parse($watcher->election->voting_end);
                $watcher->election->is_active = $now->between(Carbon::parse($watcher->election->voting_start), $votingEnd);
                $watcher->election->time_remaining = $watcher->election->is_active ? $votingEnd->diffForHumans(null, true) : null;
                $watcher->election->voting_end_timestamp = $votingEnd->timestamp;
            }
        }
        
        return view('userwatchers.index', compact('watchers')); 
    }
    
    public function getVoteCounts(Request $request, $electionId)
    {
        $user = Auth::user();
        $isWatcher = Watcher::where('user_id', $user->id)
                            ->where('election_id', $electionId)
                            ->exists();
        
        // If user is not a watcher and not a professor, return unauthorized
        if (!$isWatcher && $user->type !== 'professor') {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
        
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
