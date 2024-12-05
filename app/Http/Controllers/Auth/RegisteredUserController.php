<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;

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
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'in:2,3'], // Validate that role_id is either 2 (Organizer) or 3 (User/Attendee)

        ]);

        // Create the user with a default role (e.g., Attendee role with role_id = 3)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // Validate that role_id is either 2 (Organizer) or 3 (User/Attendee)
        ]);

        Mail::to($user->email)->send(new UserRegisteredMail($user));
        // Fire the registered event and log the user in
        event(new Registered($user));
        //Auth::login($user);

        // Redirect to home
        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }


}
