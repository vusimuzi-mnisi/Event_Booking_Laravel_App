<form action="{{ $paypalUrl }}" method="POST">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="{{ $businessEmail }}">
    <input type="hidden" name="item_name" value="Event Booking">
    <input type="hidden" name="item_number" value="{{ $bookingId }}">
    <input type="hidden" name="amount" value="{{ $totalAmount }}">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="{{ route('payment.success') }}"> <!-- Redirect URL after payment success -->
    <input type="hidden" name="cancel_return" value="{{ route('payment.cancel') }}"> <!-- Redirect URL if payment is canceled -->

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Pay with PayPal
    </button>
</form>
