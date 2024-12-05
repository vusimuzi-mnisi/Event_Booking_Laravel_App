<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class OrganizerDashboardController extends Controller
{
    public function index()
    {
        // Fetch events created by the logged-in organizer
        $events = Event::where('user_id', Auth::id())->with('category', 'bookings')->get();

        return view('organizer.dashboard', compact('events'));
    }
}
