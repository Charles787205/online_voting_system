<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;
use App\Models\Position;

class ElectionController extends Controller
{
    /**
     * Display a listing of the elections.
     */
    public function index()
    {
        $elections = Election::all(['id', 'name', 'voting_start', 'voting_end', 'election_start', 'election_end']);
        return view('elections.index', compact('elections'));
    }

    /**
     * Show the form for creating a new election.
     */
    public function create()
    {
        return view('elections.create');
    }

    /**
     * Store a newly created election in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'voting_start' => 'required|date',
            'voting_end' => 'required|date|after:voting_start',
            'election_start' => 'required|date',
            'election_end' => 'required|date|after:election_start',
        ]);

        Election::create($validated);

        return redirect()->route('elections.index')->with('success', 'Election created successfully.');
    }

    /**
     * Display the specified election.
     */
    public function show(Election $election)
    {
        $availablePositions = Position::all();
        return view('elections.show', compact('election', 'availablePositions'));
    }

    /**
     * Show the form for editing the specified election.
     */
    public function edit(Election $election)
    {
        $availablePositions = Position::all();
        return view('elections.edit', compact('election', 'availablePositions'));
    }

    /**
     * Update the specified election in storage.
     */
    public function update(Request $request, Election $election)
    {
        $validated = $request->validate([
            'voting_start' => 'required|date',
            'voting_end' => 'required|date|after:voting_start',
            'election_start' => 'required|date',
            'election_end' => 'required|date|after:election_start',
        ]);

        $election->update($validated);

        return redirect()->route('elections.index')->with('success', 'Election updated successfully.');
    }

    /**
     * Remove the specified election from storage.
     */
    public function destroy(Election $election)
    {
        $election->delete();

        return redirect()->route('elections.index')->with('success', 'Election deleted successfully.');
    }

    /**
     * Add a position to the specified election.
     */
    public function addPosition(Request $request, Election $election)
    {
        try {
            $validated = $request->validate([
                'position_id' => 'required|exists:positions,id',
                'available_positions' => 'required|integer|min:1',
            ]);

            $election->positions()->attach($validated['position_id'], ['available_positions' => $validated['available_positions']]);

            return redirect()->route('elections.show', $election)->with('success', 'Position added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('elections.show', $election)->withErrors(['error' => 'Failed to add position' ]);
        }
    }

    /**
     * Remove a position from the specified election.
     */
    public function deletePosition(Request $request, Election $election)
    {
        try {
            $validated = $request->validate([
                'delete_position_id' => 'required|exists:positions,id',
            ]);

            $election->positions()->detach($validated['delete_position_id']);

            return redirect()->route('elections.show', $election)->with('success', 'Position deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('elections.show', $election)->withErrors(['error' => 'Failed to delete position' ]);
        }
    }

    /**
     * Edit a position in the specified election.
     */
    public function editPosition(Request $request, Election $election)
    {
        try {
            $validated = $request->validate([
                'position_id' => 'required|exists:positions,id',
                'available_positions' => 'required|integer|min:1',
            ]);

            $election->positions()->updateExistingPivot($validated['position_id'], ['available_positions' => $validated['available_positions']]);

            return redirect()->route('elections.show', $election)->with('success', 'Position updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('elections.show', $election)->withErrors(['error' => 'Failed to update position ' ]);
        }
    }
}