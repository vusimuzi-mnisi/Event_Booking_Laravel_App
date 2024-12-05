<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Booking Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">

<!-- Navbar -->
<nav class="bg-white dark:bg-gray-800 shadow">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-gray-800 dark:text-white">Teambix Event Master</a>
        @if (Route::has('login'))
            <div class="flex space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<!-- Hero Section -->
<header class="relative bg-gray-50 dark:bg-gray-800">
    <div class="container mx-auto px-6 lg:px-20 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white leading-tight">
            Discover and Book Events Effortlessly
        </h1>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
            The ultimate platform to explore exciting events and secure your spot with just a few clicks.
        </p>
        <div class="mt-8">
            <a href="{{ route('register') }}" class="px-6 py-3 text-lg text-white bg-blue-600 hover:bg-blue-700 rounded shadow-md">
                Get Started
            </a>
        </div>
    </div>
</header>

<!-- Features Section -->
<section id="features" class="py-16 bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto px-6 lg:px-20">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-12">Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-blue-600 text-white rounded-full mb-4">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3M17 16h3M19 16v5m0-5v-5m-2 0h2" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Easy Event Management</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Create, update, and manage events with ease using our intuitive interface.</p>
            </div>

            <!-- Feature 2 -->
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-blue-600 text-white rounded-full mb-4">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Seamless Bookings</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Book tickets effortlessly and manage your reservations in one place.</p>
            </div>

            <!-- Feature 3 -->
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-blue-600 text-white rounded-full mb-4">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3M17 16h3M19 16v5m0-5v-5m-2 0h2" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Registration for Different Roles</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Organizers and attendees get tailored features for their roles.</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="container mx-auto px-6 lg:px-20">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-12">About Us</h2>
        <p class="text-lg text-gray-600 dark:text-gray-300 text-center">
            Our platform connects event organizers and attendees, providing a seamless experience for managing and booking events. Whether it's a concert, workshop, or conference, we've got you covered!
        </p>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-gray-400 py-8 text-center">
    <p>&copy; {{ date('Y') }} Teambix Event Booking App. All Rights Reserved.</p>
</footer>

</body>
</html>
