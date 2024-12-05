<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('General Dashboard') }}
            </h2>
            <div class="mb-4">
                <a
                    href="{{ route('bookings.index') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    View My Bookings
                </a>
            </div>
        </div>
    </x-slot>

    <div class="mb-8">


        <h3 class="text-xl font-semibold">Upcoming Events</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
            @foreach ($events as $event)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h4 class="font-bold text-lg">{{ $event->name }}</h4>
                    <p class="text-gray-700">{{ $event->description }}</p>
                    <p class="text-gray-500">Location: {{ $event->location }}</p>
                    <p class="text-gray-500">Date: {{ $event->date_time }}</p>
                    <p class="text-gray-500">Ticket Price: R{{ $event->ticket_price }}</p>
                    <form action="{{ route('events.show', $event->id) }}" method="GET">
                        @csrf
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            Book Event
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
