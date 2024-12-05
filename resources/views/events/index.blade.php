<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>
    <form method="GET" class="mb-4">
        <div class="flex space-x-4">
            <select name="category" class="border p-2 rounded">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="text" name="date_range" class="border p-2 rounded" placeholder="Date Range (YYYY-MM-DD - YYYY-MM-DD)" value="{{ request('date_range') }}">

            <input type="number" name="price_min" class="border p-2 rounded" placeholder="Min Price" value="{{ request('price_min') }}">
            <input type="number" name="price_max" class="border p-2 rounded" placeholder="Max Price" value="{{ request('price_max') }}">

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Filter</button>
        </div>
    </form>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Upcoming Events</h1>

        @foreach ($events as $event)
            <div class="border-b py-4">
                <h2 class="text-xl font-semibold">{{ $event->name }}</h2>
                <p>{{ $event->category->name }} | {{ $event->date->format('M d, Y') }}</p>
                <p>{{ Str::limit($event->description, 100) }}</p>
                <a href="{{ route('events.show', $event) }}" class="text-blue-600">View Details</a>
            </div>
        @endforeach

        {{ $events->links() }}  <!-- Pagination links -->
    </div>
</x-app-layout>
