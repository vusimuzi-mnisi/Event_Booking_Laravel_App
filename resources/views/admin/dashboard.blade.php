<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Events Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Events</h3>
                    <table class="min-w-full mt-4 bg-gray-100 dark:bg-gray-900 border border-gray-300 dark:border-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Event Name</th>
                            <th class="px-4 py-2">Date & Time</th>
                            <th class="px-4 py-2">Location</th>
                            <th class="px-4 py-2">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($events as $event)
                            <tr class="border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-2">{{ $event->id }}</td>
                                <td class="px-4 py-2">{{ $event->name }}</td>
                                <td class="px-4 py-2">{{ $event->date_time }}</td>
                                <td class="px-4 py-2">{{ $event->location }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Users Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Users</h3>
                    <table class="min-w-full mt-4 bg-gray-100 dark:bg-gray-900 border border-gray-300 dark:border-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-2">{{ $user->id }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->role->name }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bookings Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Bookings</h3>
                    <table class="min-w-full mt-4 bg-gray-100 dark:bg-gray-900 border border-gray-300 dark:border-gray-700">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Event</th>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Booked At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-2">{{ $booking->id }}</td>
                                <td class="px-4 py-2">{{ $booking->event->name }}</td>
                                <td class="px-4 py-2">{{ $booking->user->name }}</td>
                                <td class="px-4 py-2">{{ $booking->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
