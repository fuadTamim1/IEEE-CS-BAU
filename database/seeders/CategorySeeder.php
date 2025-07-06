<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ["title" => "IT", "image" => "null"],
            ["title" => "Network", "image" => "null"],
            ["title" => "Cyber Security", "image" => "null"],
            ["title" => "Python", "image" => "null"],
            ["title" => "AI", "image" => "null"],
            ["title" => "AI", "image" => "null"],
            ["title" => "Web Development", "image" => "null"],
            ["title" => "Mobile Development", "image" => "null"],
            ["title" => "Game Development", "image" => "null"],
            ["title" => "Data Science", "image" => "null"],
            ["title" => "Cloud Computing", "image" => "null"],
            ["title" => "DevOps", "image" => "null"],
            ["title" => "Blockchain", "image" => "null"],
            ["title" => "Software Engineering", "image" => "null"],
            ["title" => "Project Management", "image" => "null"],
            ["title" => "Digital Marketing", "image" => "null"],
            ["title" => "UI/UX Design", "image" => "null"],
            ["title" => "Game Design", "image" => "null"],
            ["title" => "Robotics", "image" => "null"],
            ["title" => "Internet of Things (IoT)", "image" => "null"],
            ["title" => "Augmented Reality (AR)", "image" => "null"],
            ["title" => "Virtual Reality (VR)", "image" => "null"],
            ["title" => "Quantum Computing", "image" => "null"],
            ["title" => "Ethical Hacking", "image" => "null"],
            ["title" => "Mobile App Development", "image" => "null"],
        ]);
    }
}
