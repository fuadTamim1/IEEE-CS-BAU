<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize Faker
        $faker = Faker::create();

        // Get all existing categories
        $categories = Category::pluck('id')->toArray();

        // Get all existing users (authors)
        $authors = User::pluck('id')->toArray();

        // Create 50 fake blog posts
        for ($i = 0; $i < 1; $i++) {
            Blog::create([
                'title' => $faker->sentence(6), // Generate a random title
                'slug' => Str::slug($faker->unique()->sentence(6)), // Generate a unique slug
                'tags' => implode(',', $faker->words(3)), // Generate 3 random tags
                'content' => $faker->paragraphs(5, true), // Generate 5 paragraphs of content
                'image' => $faker->imageUrl(640, 480, 'technics'), // Generate a random image URL
                'is_published' => $faker->boolean(80), // 80% chance of being published
                'author_id' => $faker->randomElement($authors), // Assign a random author
                'category_id' => $faker->randomElement($categories), // Assign a random category
                'created_at' => $faker->dateTimeBetween('-1 year', '+1 year'), // Random creation date within the past year
                'updated_at' => $faker->dateTimeBetween('-1 year', '+1 year'), // Random update date within the past year
            ]);
        }
    }
}
