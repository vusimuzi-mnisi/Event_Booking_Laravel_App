<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Bookings') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">back to dashboard</a>

        </div>
    </x-slot>

    <div class="mb-8">
        <h3 class="text-xl font-semibold">Your Bookings</h3>
        @if ($bookings->isEmpty())
            <p class="text-gray-500 mt-4">You have no bookings yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
                @foreach ($bookings as $booking)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h4 class="font-bold text-lg">{{ $booking->event->name }}</h4>
                        <p class="text-gray-700">{{ $booking->event->description }}</p>
                        <p class="text-gray-500">Location: {{ $booking->event->location }}</p>
                        <p class="text-gray-500">Date: {{ $booking->event->date_time }}</p>
                        <p class="text-gray-500">Tickets Booked: {{ $booking->ticket_quantity }}</p>
                        <p class="text-gray-500">Total Price: R{{ $booking->ticket_quantity * $booking->event->ticket_price }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
