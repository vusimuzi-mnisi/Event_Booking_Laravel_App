<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pay For Booking') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
        <p class="text-xl font-bold text-center mb-4">
            Total Amount: R{{ number_format($totalAmount, 2) }}
        </p>

        <form action="{{ $paypalUrl }}" method="POST" class="w-full">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="{{ $businessEmail }}">
            <input type="hidden" name="item_number" value="{{ $bookingId }}">
            <input type="hidden" name="amount" value="{{ $totalAmount }}">
            <input type="hidden" name="currency_code" value="ZAR">
            <input type="hidden" name="return" value="{{ route('payment.success') }}">
            <input type="hidden" name="cancel_return" value="{{ route('payment.cancel') }}">

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 transition duration-150 ease-in-out">
                Pay with PayPal
            </button>
        </form>

        <!-- Cancel Booking Button -->
        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="text-red-500 hover:text-red-700 font-semibold">
                Cancel Booking
            </a>
        </div>
    </div>
</x-app-layout>
