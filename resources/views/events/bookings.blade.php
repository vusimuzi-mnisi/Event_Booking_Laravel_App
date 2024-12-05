<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Bookings for Event: ') . $event->name }}
            </h2>
            <a href="{{ route('organizer.dashboard') }}" class="text-blue-600 hover:text-blue-800">back to dashboard</a>

        </div>
    </x-slot>

    <div class="container mx-auto mt-6">
        @if ($bookings->isEmpty())
            <p>No bookings found for this event.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                <tr>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Tickets</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($bookings as $booking)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">{{ $booking->user->name }}</td>
                        <td class="px-4 py-2">{{ $booking->ticket_quantity }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
