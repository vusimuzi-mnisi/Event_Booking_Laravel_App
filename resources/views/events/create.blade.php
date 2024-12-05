<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Event') }}
            </h2>
            <a href="{{ route('organizer.dashboard') }}" class="text-blue-600 hover:text-blue-800">back to dashboard</a>

        </div>
    </x-slot>
    <div class="container mx-auto p-4">

        <form action="{{ route('events.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium">Event Name</label>
                <input type="text" name="name" id="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
                @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block font-medium">Description</label>
                <textarea name="description" id="description" class="w-full border rounded p-2" required>{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date_time" class="block font-medium">Date and Time</label>
                <input type="datetime-local" name="date_time" id="date_time" class="w-full border rounded p-2" value="{{ old('date_time') }}" required>
                @error('date_time')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location" class="block font-medium">Location</label>
                <input type="text" name="location" id="location" class="w-full border rounded p-2" value="{{ old('location') }}" required>
                @error('location')
                <p class="text-red-500 text-sm">{{ $message }}</p>
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
                <input type="number" name="max_attendees" id="max_attendees" class="w-full border rounded p-2" value="{{ old('max_attendees') }}" required>
                @error('max_attendees')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="ticket_price" class="block font-medium">Ticket Price</label>
                <input type="number" name="ticket_price" id="ticket_price" step="0.01" class="w-full border rounded p-2" value="{{ old('ticket_price') }}" required>
                @error('ticket_price')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Event</button>
        </form>
    </div>
</x-app-layout>
