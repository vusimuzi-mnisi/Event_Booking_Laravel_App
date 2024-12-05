<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Fetch or create the Organizer user
        $organizer = User::firstOrCreate([
            'email' => 'organizer@example.com', // Assuming the email for the organizer
        ], [
            'name' => 'Organizer User',
            'password' => bcrypt('password'), // Set a password
            'role_id' => 2, // Assuming the 'Organizer' role has ID 2
        ]);

        // Fetch all categories (Assuming categories already exist)
        $categories = Category::all();

        // Create events for the organizer
        Event::create([
            'user_id' => $organizer->id,
            'category_id' => $categories->random()->id, // Random category
            'name' => 'Rock Concert',
            'description' => 'A live rock concert featuring popular bands.',
            'location' => 'New York, NY',
            'date_time' => Carbon::parse('2024-12-08 15:30:00'),
            'max_attendees' => 500,
            'ticket_price' => 50.00,
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'category_id' => $categories->random()->id, // Random category
            'name' => 'Tech Conference',
            'description' => 'A technology conference for developers and tech enthusiasts.',
            'location' => 'San Francisco, CA',
            'date_time' => Carbon::parse('2024-12-10 09:00:00'),
            'max_attendees' => 300,
            'ticket_price' => 150.00,
        ]);

        Event::create([
            'user_id' => $organizer->id,
            'category_id' => $categories->random()->id, // Random category
            'name' => 'Art Gallery Opening',
            'description' => 'An exclusive opening of a new art gallery.',
            'location' => 'Los Angeles, CA',
            'date_time' => Carbon::parse('2024-12-12 18:00:00'),
            'max_attendees' => 200,
            'ticket_price' => 25.00,
        ]);
    }
}
