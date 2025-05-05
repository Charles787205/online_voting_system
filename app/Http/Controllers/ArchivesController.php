<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;

class ArchivesController extends Controller
{
    public function index()
    {
        $archivedElections = Election::where('is_archived', true)->get();
        return view('elections.get_archives', compact('archivedElections'));
    }
}
