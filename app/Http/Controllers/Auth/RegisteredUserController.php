<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\StudentDetail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'type' => 'required|in:professor,student',
            'id_number' => 'required_if:type,student|string|unique:student_details,id_number',
            'year' => 'required_if:type,student|string',
            'course' => 'required_if:type,student|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        if (User::count() === 0) {
            $validated['is_admin'] = true;
        } else {
            $validated['is_admin'] = false;
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'type' => $validated['type'],
            'is_admin' => $validated['is_admin'],
        ]);

        if ($validated['type'] === 'student') {
            StudentDetail::create([
                'user_id' => $user->id,
                'id_number' => $validated['id_number'],
                'year' => $validated['year'],
                'course' => $validated['course'],
            ]);
        }

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
