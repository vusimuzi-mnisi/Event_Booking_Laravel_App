<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Music']);
        Category::create(['name' => 'Sports']);
        Category::create(['name' => 'Education']);
        Category::create(['name' => 'Tech']);
    }
}
