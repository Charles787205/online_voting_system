<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Election;
use App\Models\Nominee;
use App\Models\Vote;
use App\Models\ElectionPosition;
class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return redirect()->route('dashboard');
        }

        return view('students.index', compact('user'));
    }

    public function vote()
    {   
        $elections = Election::all();
        foreach ($elections as $election) {
            $election->positions = $election->electionPositions->load('nominees');
        }
        $electionIds = $elections->pluck('id')->toArray();
        $votes = Vote::where('student_id', Auth::id())
            ->whereIn('election_id', $electionIds)
            ->get();

        return view('students.vote', compact('elections'));
    }

    public function nominate()
    {
        $elections = Election::with('positions')->get();

        return view('students.nominate', compact('elections'));
    }

    public function elections()
    {
        $elections = Election::all();
        foreach ($elections as $election) {
            $election->positions = $election->electionPositions->load('nominees');
            
            // Check if the current user has voted in this election
            $election->hasVoted = Vote::where('student_id', Auth::id())
                ->where('election_id', $election->id)
                ->exists();
        }
        $electionIds = $elections->pluck('id')->toArray();
        $votes = Vote::where('student_id', Auth::id())
            ->whereIn('election_id', $electionIds)
            ->get();

        return view('students.elections', compact('elections'));
    }

    public function nominateSelf(Request $request)
    {
        $validated = $request->validate([
            'election_id' => 'required|exists:elections,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        try {
            $nominee = new Nominee();
            $nominee->student_id = Auth::id();

            $election_positions = ElectionPosition::where('election_id', $validated['election_id'])
                ->where('position_id', $validated['position_id'])
                ->first();

            if (!$election_positions) {
                return redirect()->back()->withErrors(['error' => 'Invalid election or position.']);
            }

            $nominee->election_positions_id = $election_positions->id;
            $nominee->save();

            return redirect()->back()->with('success', 'You have successfully nominated yourself.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                return redirect()->back()->withErrors(['error' => 'You are already nominated for this position.']);
            }

            throw $e; // Re-throw if it's not an integrity constraint violation
        }
    }

    public function electionDetails($id)
    {
        try {
            $election = Election::with(['electionPositions.nominees.position', 'electionPositions.nominees.student'])->findOrFail($id);

            // Check if user has already voted in this election
            $hasVoted = Vote::where('student_id', Auth::id())
                ->where('election_id', $id)
                ->exists();

            return view('students.election_details', compact('election', 'hasVoted'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function submitVote(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nominee' => 'required|array',
                'nominee.*' => 'nullable|exists:nominees,id',
            ]);

            foreach ($validated['nominee'] as $positionId => $nomineeId) {
                if ($nomineeId) {
                    Vote::updateOrCreate(
                        [
                            'student_id' => Auth::id(),
                            'election_id' => $id,
                            'nominee_id' => $nomineeId,
                        ]
                    );
                }
            }

            return redirect()->route('student.electionDetails', $id)->with('success', 'Your vote has been submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while submitting your vote: ' . $e->getMessage()]);
        }
    }
}