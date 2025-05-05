<?php
namespace App\Http\Controllers;

use App\Models\Watcher;
use App\Models\User;
use App\Models\Election;
use App\Models\Nominee;
use Illuminate\Http\Request;

class WatcherController extends Controller
{
    public function index()
    {
        $watchers = Watcher::with(['user', 'election', 'nominee'])->get();
        return view('watchers.index', compact('watchers'));
    }

    public function create()
    {
        $users = User::all();
        $elections = Election::all();
        $nominees = Nominee::all();

        return view('watchers.create', compact('users', 'elections', 'nominees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'election_id' => 'required|exists:elections,id',
            'nominee_id' => 'required|exists:nominees,id',
        ]);

        Watcher::create($validated);

        return redirect()->route('watchers.index')->with('success', 'Watcher added successfully.');
    }

    public function show(Watcher $watcher)
    {
        return view('watchers.show', compact('watcher'));
    }

    public function edit(Watcher $watcher)
    {
        return view('watchers.edit', compact('watcher'));
    }

    public function update(Request $request, Watcher $watcher)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'election_id' => 'required|exists:elections,id',
            'nominee_id' => 'required|exists:nominees,id',
        ]);

        $watcher->update($validated);

        return redirect()->route('watchers.index')->with('success', 'Watcher updated successfully.');
    }

    public function destroy(Watcher $watcher)
    {
        $watcher->delete();

        return redirect()->route('watchers.index')->with('success', 'Watcher deleted successfully.');
    }
}