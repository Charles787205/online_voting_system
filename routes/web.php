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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth',)->group(function () {
    Route::middleware(CheckAdmin::class)->group(function () {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Admin routes
        Route::resource('elections', ElectionController::class);
        Route::resource('nominees', NomineeController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('users', UserController::class);
        Route::resource('watchers', WatcherController::class);
        Route::resource('votes', VoteController::class);
        Route::resource('elections', ElectionController::class);
        Route::post('/elections/{election}/add-position', [ElectionController::class, 'addPosition'])->name('elections.add_position');
        Route::delete('/elections/{election}/delete-position', [ElectionController::class, 'deletePosition'])->name('elections.delete_position');
        Route::put('/elections/{election}/edit-position', [ElectionController::class, 'editPosition'])->name('elections.edit_position');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Election routes
    
    // Nominee routes
  

    // Student routes
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/vote', [StudentController::class, 'vote'])->name('student.vote');
    Route::get('/student/nominate', [StudentController::class, 'nominate'])->name('student.nominate');
    Route::get('/student/elections', [StudentController::class, 'elections'])->name('student.elections');
    Route::get('student/elections/{id}', [StudentController::class, 'electionDetails'])->name('student.electionDetails');
    Route::post('/nominate-self', [StudentController::class, 'nominateSelf'])->name('nominate.self');
    Route::post('student/elections/{id}/vote', [StudentController::class, 'submitVote'])->name('student.vote.submit');
    
});

require __DIR__.'/auth.php';
