<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Organizer Dashboard') }}
            </h2>
            <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Create Event</a>
        </div>
    </x-slot>

    <div class="container mx-auto mt-6">
        @if ($events->isEmpty())
            <div class="text-center">
                <p class="text-gray-600">You have not created any events yet.</p>
                <a href="{{ route('events.create') }}" class="text-blue-500 hover:text-blue-700 font-semibold">Create an Event</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Event Name</th>
                        <th class="px-4 py-2 text-left text-gray-600">Category</th>
                        <th class="px-4 py-2 text-left text-gray-600">Date</th>
                        <th class="px-4 py-2 text-left text-gray-600">Bookings</th>
                        <th class="px-4 py-2 text-left text-gray-600">Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($events as $event)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $event->name }}</td>
                            <td class="px-4 py-2">{{ $event->category->name }}</td>
                            <td class="px-4 py-2">{{ $event->date_time }}</td>
                            <td class="px-4 py-2">
                                <span class="text-gray-600">{{ $event->bookings->count() }} bookings</span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('events.edit', $event) }}" class="text-blue-500 hover:text-blue-700">Edit</a> |
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form> |
                                <a href="{{ route('events.bookings', $event) }}" class="text-green-600 hover:text-green-800">Bookings</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
