<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\NomineeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\WatcherController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\UserWatchersController;
use App\Http\Middleware\CheckIfWatcher;
use App\CheckIfStudentAndNotWatcher;
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/userwatchers/{electionId}', [UserWatchersController::class, 'getVoteCounts'])->name('userwatchers.votes');
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // Check if user is a watcher
    
    
    return redirect()->route('userwatchers.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth',)->group(function () {

    
    Route::resource('userwatchers', UserWatchersController::class)->middleware(CheckIfWatcher::class);
    // Add this route to match the fetch URL in the JavaScript
    
    Route::get('/election/{id}/votes', [UserWatchersController::class, 'getVoteCounts'])->name('election.votes');

    Route::middleware(CheckAdmin::class)->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

    
        
        Route::resource('nominees', NomineeController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('users', UserController::class);
        Route::resource('watchers', WatcherController::class);
        Route::resource('archives', ArchivesController::class);
        Route::resource('votes', VoteController::class);
        Route::post('/elections/{election}/add-position', [ElectionController::class, 'addPosition'])->name('elections.add_position');
        Route::delete('/elections/{election}/delete-position', [ElectionController::class, 'deletePosition'])->name('elections.delete_position');
        Route::put('/elections/{election}/edit-position', [ElectionController::class, 'editPosition'])->name('elections.edit_position');
        
        Route::resource('elections', ElectionController::class);
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::middleware('student.not.watcher')->group(function () {
        Route::get('/student', [StudentController::class, 'index'])->name('student.index');
        Route::get('/student/vote', [StudentController::class, 'vote'])->name('student.vote');
        Route::get('/student/nominate', [StudentController::class, 'nominate'])->name('student.nominate');
        Route::get('/student/elections', [StudentController::class, 'elections'])->name('student.elections');
        Route::get('student/elections/{id}', [StudentController::class, 'electionDetails'])->name('student.electionDetails');
        Route::post('/nominate-self', [StudentController::class, 'nominateSelf'])->name('nominate.self');
        Route::post('student/elections/{id}/vote', [StudentController::class, 'submitVote'])->name('student.vote.submit');
    });
    
});

require __DIR__.'/auth.php';
