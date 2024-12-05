<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;

class BookingController extends Controller
{
    // Show all bookings for a specific event
    public function indexForOrganizer(Event $event)
    {
        // Ensure the user is the organizer of the event
        if ($event->user_id !== auth()->id()) {
            return redirect()->route('organizer.dashboard')->with('error', 'You are not authorized to manage this event.');
        }

        // Get all bookings for this event
        $bookings = $event->bookings()->with('user')->get();

        return view('events.bookings', compact('event', 'bookings'));
    }

    // 2. User's Personal Bookings
    public function indexForUser()
    {
        // Get bookings for the authenticated user
        $bookings = Booking::where('user_id', auth()->id())->with('event')->get();

        return view('bookings.index', compact('bookings'));
    }
    // Cancel a booking (delete it)
    public function destroy(Booking $booking)
    {
        try {
            // Load the related event for the booking
            $event = $booking->event;

            // Check if the authenticated user is the owner of the event
            if ($event->user_id !== auth()->id()) {
                return redirect()->route('organizer.dashboard')
                    ->with('error', 'You are not authorized to delete this booking.');
            }

            // Delete the booking
            $booking->delete();

            return redirect()->route('events.bookings', ['event' => $event->id])
                ->with('success', 'Booking canceled successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete booking.', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('organizer.dashboard')
                ->with('error', 'Failed to cancel the booking. Please try again later.');
        }
    }



    public function store(Request $request, Event $event)
    {
        // Validate ticket quantity
        $request->validate([
            'ticket_quantity' => 'required|integer|min:1|max:' . ($event->max_attendees - $event->bookings->sum('ticket_quantity')),
        ]);

        // Check if tickets are available
        if ($event->bookings->sum('ticket_quantity') + $request->ticket_quantity > $event->max_attendees) {
            return redirect()->route('events.show', $event->id)->with('error', 'Not enough tickets available.');
        }

        // Create the booking (without payment for now)
        $booking = Booking::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'ticket_quantity' => $request->ticket_quantity,
        ]);
        Mail::to(auth()->user()->email)->send(new BookingConfirmationMail($booking));


        // Calculate total amount
        $totalAmount = $request->ticket_quantity * $event->ticket_price;

        // Redirect to PayPal for payment
        return redirect()->route('paypal.payment', ['booking' => $booking->id, 'total_amount' => $totalAmount]);
    }


    public function storePayment(Request $request, Event $event)
    {
        // Validate and store the booking
        $request->validate([
            'ticket_quantity' => 'required|integer|min:1|max:' . ($event->max_attendees - $event->bookings->sum('ticket_quantity')),
        ]);

        // Create the booking
        $booking = Booking::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'ticket_quantity' => $request->ticket_quantity,
        ]);

        // Calculate the total amount (e.g., ticket price * quantity)
        $totalAmount = $event->ticket_price * $request->ticket_quantity;

        // Store the payment information in the database with status 'pending'
        $payment = Payment::create([
            'user_id' => auth()->id(),
            'booking_id' => $booking->id,
            'amount' => $totalAmount,
            'payment_status' => 'pending', // Payment status is 'pending' initially
        ]);

        // Prepare PayPal data (e.g., business email, return URLs)
        $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // PayPal sandbox URL for testing
        $businessEmail = 'your-paypal-email@example.com'; // Your PayPal business email

        // Return the view for PayPal redirection
        return view('paypal.redirect', compact('paypalUrl', 'businessEmail', 'totalAmount', 'booking->id'));
    }



}
