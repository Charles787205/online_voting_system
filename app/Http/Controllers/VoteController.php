<?php
namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return view('votes.index', compact('elections'));
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