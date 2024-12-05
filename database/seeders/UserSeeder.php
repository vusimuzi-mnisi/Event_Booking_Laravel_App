<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure roles exist or create them
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $organizerRole = Role::firstOrCreate(['name' => 'Organizer']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Create an Attendee user
        User::create([
            'name' => 'Attendee',
            'email' => 'attendee@example.com',
            'password' => bcrypt('password'),
            'role_id' => $userRole->id, // Using the id of the created role
        ]);

        // Create an Organizer user
        User::create([
            'name' => 'Organizer',
            'email' => 'organizer@example.com',
            'password' => bcrypt('password'),
            'role_id' => $organizerRole->id, // Using the id of the created role
        ]);

        // Create an Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id, // Using the id of the created role
        ]);
    }

}
