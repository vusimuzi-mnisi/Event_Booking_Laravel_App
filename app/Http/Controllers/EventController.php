<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class EventController extends Controller
{

    public function index(Request $request)
    {
        $query = Event::where('date_time', '>', now())->get();

        // Filters
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date_range')) {
            // Assuming date_range is in the form 'start_date-end_date'
            list($start_date, $end_date) = explode('-', $request->date_range);
            $query->whereBetween('date', [$start_date, $end_date]);
        }

        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('ticket_price', [$request->price_min, $request->price_max]);
        }

        $events = $query;
        return view('dashboard', compact('events'));
    }
    public function show(Event $event)
    {
        // Calculate the total amount based on ticket price and available quantity
        $totalAmount = $event->ticket_price; // assuming ticket price is stored in 'ticket_price' field

        // Check if the ticket quantity is passed in the query parameters or default to 1
        if (request()->has('ticket_quantity')) {
            $ticketQuantity = request()->input('ticket_quantity');
        } else {
            $ticketQuantity = 1; // default to 1 if no quantity is selected
        }

        // Calculate the total amount based on the quantity
        $totalAmount = $ticketQuantity * $event->ticket_price;

        // Pass the totalAmount and event to the view
        return view('events.show', compact('event', 'totalAmount'));
    }


    // Show the event creation form
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    // Store the event in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        // Assign the logged-in user as the organizer
        $validatedData['user_id'] = auth()->id();

        // Save the event
        Event::create($validatedData);

        return redirect()->route('organizer.dashboard')->with('success', 'Event created successfully!');
    }
    public function update(Request $request, Event $event)
    {


        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'max_attendees' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        // Update the event
        $event->update($request->all());

        // Redirect back with a success message
        return redirect()->route('organizer.dashboard')->with('success', 'Event updated successfully.');
    }
    public function edit(Event $event)
    {
        if ($event->user_id !== auth()->id())
        {
            return redirect()->route('organizer.dashboard')->with('error', 'You are not authorized to manage this event.');

        }

        $categories = Category::all();

        // Pass the event to the edit view
        return view('events.edit', [
            'event' => $event,
            'categories' => $categories,
        ]);

    }

    public function destroy(Event $event)
    {
        try {
            // Check if the authenticated user is the event owner OR has an admin role
            if ($event->user_id !== auth()->id() && auth()->user()->role->name !== 'Admin') {
                return redirect()->route('organizer.dashboard')
                    ->with('error', 'You are not authorized to delete this event.');
            }

            // Delete all related bookings and then the event
            $event->bookings()->delete();
            $event->delete();

            // Redirect based on the user's role
            if (auth()->user()->role->name === 'Admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Event and related bookings deleted successfully.');
            }

            // Default redirect for organizers
            return redirect()->route('organizer.dashboard')
                ->with('success', 'Event and related bookings deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete event.', [
                'event_id' => $event->id,
                'error' => $e->getMessage(),
            ]);

            // Redirect to the appropriate dashboard in case of an error
            if (auth()->user()->role->name === 'Admin') {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Failed to delete the event. Please try again later.');
            }

            return redirect()->route('organizer.dashboard')
                ->with('error', 'Failed to delete the event. Please try again later.');
        }
    }






}

