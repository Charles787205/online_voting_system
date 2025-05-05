<?php

namespace App\Http\Controllers;

use App\Models\Nominee;
use App\Models\StudentDetail;
use App\Models\ElectionPosition;
use Illuminate\Http\Request;
use App\Models\Election;
class NomineeController extends Controller
{
    public function index()
    {
        $nominees = Nominee::with(['student', 'electionPosition'])->get();
        return view('nominees.index', compact('nominees'));
    }

    public function create()
    {
        $students = StudentDetail::all();
        
        $elections = Election::with('positions')->get();
        return view('nominees.create', compact('students', 'elections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:student_details,id_number',
            'election_id' => 'required|exists:elections,id',
            'position_id' => 'required|exists:positions,id',
        ]);
        $electionPosition = ElectionPosition::get()->where('election_id', $validated['election_id'])->where('position_id', $validated['position_id'])->first();
        $validated['election_positions_id'] = $electionPosition->id;

        Nominee::create($validated);

        return redirect()->route('nominees.index')->with('success', 'Nominee added successfully.');
    }

    public function show(Nominee $nominee)
    {
        return view('nominees.show', compact('nominee'));
    }

    public function edit(Nominee $nominee)
    {
        return view('nominees.edit', compact('nominee'));
    }

    public function update(Request $request, Nominee $nominee)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:student_details,id_number',
            'election_positions_id' => 'required|exists:election_positions,id',
        ]);

        $nominee->update($validated);

        return redirect()->route('nominees.index')->with('success', 'Nominee updated successfully.');
    }

    public function destroy(Nominee $nominee)
    {
        $nominee->delete();

        return redirect()->route('nominees.index')->with('success', 'Nominee deleted successfully.');
    }
}