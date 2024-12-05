<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Event Details') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">back to dashboard</a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold">{{ $event->name }}</h3>
                    <p>{{ $event->description }}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
                    <p><strong>End Time:</strong> {{ $event->end_time }}</p>
                    <p><strong>Available Tickets:</strong>
                        {{ $event->max_attendees - $event->bookings->sum('ticket_quantity') }}
                    </p>

                    <!-- Booking and Payment Form -->
                    <form action="{{ route('bookings.store', $event->id) }}" method="POST" class="mt-4">
                        @csrf
                        <div>
                            <label for="ticket_quantity" class="block text-sm font-medium text-gray-700">Number of Tickets</label>
                            <input
                                type="number"
                                id="ticket_quantity"
                                name="ticket_quantity"
                                min="1"
                                max="{{ $event->max_attendees - $event->bookings->sum('ticket_quantity') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                            @error('ticket_quantity')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- PayPal Payment Button -->
                        <input type="hidden" name="total_amount" value="{{ $totalAmount }}"> <!-- Pass the actual amount -->
                        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Book and Pay Now
                        </button>
                    </form>

                    @if (session('success'))
                        <div class="p-4 mt-4 text-green-700 bg-green-100 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mt-4 text-red-700 bg-red-100 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
