<?php

use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrganizerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// General User Dashboard: Shows events for all users (attendees)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'indexForUser'])
        ->name('bookings.index');
});

// Organizer Dashboard and Event Management
Route::middleware(['auth', 'role:Organizer'])->prefix('organizer')->group(function () {
    Route::get('/dashboard', [OrganizerDashboardController::class, 'index'])->name('organizer.dashboard');

    // Create a new event
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    // Route to view bookings for an event (Handled by BookingController)
    Route::get('/events/{event}/bookings', [BookingController::class, 'indexForOrganizer'])->name('events.bookings');
    Route::delete('/bookings/booking', [BookingController::class, 'destroy'])->name('bookings.destroy');
    // Edit an existing event
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');



});

// Admin Dashboard
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'destroy'])->name('users.destroy');
    Route::delete('/bookings/booking', [BookingController::class, 'destroy'])->name('bookings.destroy');

});


// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Route::get('paypal/payment', [PaypalController::class, 'payment'])->name('paypal.payment');
Route::get('payment/success', [PaypalController::class, 'success'])->name('payment.success');
Route::get('payment/cancel', [PaypalController::class, 'cancel'])->name('payment.cancel');


require __DIR__.'/auth.php';

