<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetch all events, users, and bookings
        $events = Event::with('user')->get(); // Fetch events with their organizers
        $users = User::with('role')->get(); // Fetch all users with their roles
        $bookings = Booking::with(['user', 'event'])->get(); // Fetch all bookings with event and user data

        // Pass the data to the admin dashboard view
        return view('admin.dashboard', compact('events', 'users', 'bookings'));
    }
    public function destroy(User $user){

        $user->delete();


        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');

    }
}
