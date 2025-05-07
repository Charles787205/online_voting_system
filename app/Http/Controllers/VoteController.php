<?php
namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        // Get the elections the current user has already voted in
        $votedElectionIds = Vote::where('student_id', Auth::id())
            ->pluck('election_id')
            ->toArray();
            
        return view('votes.index', compact('elections', 'votedElectionIds'));
    }

    public function show($id)
    {
        $election = Election::findOrFail($id);

        $positions = $election->electionPositions()
            ->with(['position', 'nominees.student'])
            ->get();

        return view('votes.show', compact('election', 'positions'));
    }
}