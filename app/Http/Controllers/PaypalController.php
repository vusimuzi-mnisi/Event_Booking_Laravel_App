<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaypalController extends Controller
{
    public function payment(Request $request)
    {
        $totalAmount = $request->total_amount;
        $bookingId = $request->booking;

        // Set PayPal payment details
        $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $businessEmail = 'sb-vzmmm34542774@business.example.com';

        return view('paypal.payment', compact('totalAmount', 'bookingId', 'paypalUrl', 'businessEmail'));
    }

    public function success(Request $request)
    {
        // Find the payment based on the booking ID (or transaction ID)
        $payment = Payment::where('booking_id', $request->booking_id)->first();

        // Update payment status to 'completed'
        if ($payment) {
            $payment->update([
                'payment_status' => 'completed',
                'transaction_id' => $request->txn_id, // PayPal transaction ID
            ]);

            // Optionally, confirm the booking and notify the user
            // e.g., send an email, mark booking as confirmed, etc.
        }

        // Redirect to a success page
        return redirect()->route('bookings.index')->with('success', 'Payment successful!');
    }

    public function cancel(Request $request)
    {
        // Find the payment and update the status
        $payment = Payment::where('booking_id', $request->booking_id)->first();
        if ($payment) {
            $payment->update(['payment_status' => 'failed']);
        }

        // Redirect to a cancellation page or notify the user
        return redirect()->route('bookings.index')->with('error', 'Payment canceled.');
    }

}
