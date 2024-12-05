<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Event') }}
            </h2>
            <a href="{{ route('organizer.dashboard') }}" class="text-blue-600 hover:text-blue-800">back to dashboard</a>

        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form action="{{ route('events.update', $event->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Event Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $event->name) }}"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Enter event name"
                    >
                    @error('name')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea
                        name="description"
                        id="description"
                        rows="4"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Enter event description"
                    >{{ old('description', $event->description) }}</textarea>
                    @error('description')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="date_time" class="block font-medium">Date and Time</label>
                    <input type="datetime-local" name="date_time" id="date_time" class="w-full border rounded p-2" value="{{ old('date_time', $event->date_time) }}" required>
                    @error('date_time')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input
                        type="text"
                        name="location"
                        id="location"
                        value="{{ old('location', $event->location) }}"
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="Enter event location"
                    >
                    @error('location')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>



                <div>
                    <label for="category_id" class="block font-medium">Category</label>
                    <select name="category_id" id="category_id" class="w-full border rounded p-2" required>
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="max_attendees" class="block font-medium">Maximum Attendees</label>
                    <input type="number" name="max_attendees" id="max_attendees" class="w-full border rounded p-2" value="{{ old('max_attendees', $event->max_attendees)}}" required>
                    @error('max_attendees')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="ticket_price" class="block font-medium">Ticket Price</label>
                    <input type="number" name="ticket_price" id="ticket_price" step="0.01" class="w-full border rounded p-2" value="{{ old('ticket_price', $event->ticket_price) }}" required>
                    @error('ticket_price')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 ms-4 bg-blue-600 hover:bg-blue-700 rounded-md font-semibold text-white  sm:text-sm"
                    >
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
