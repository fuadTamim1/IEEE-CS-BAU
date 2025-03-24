<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        // Get a random date between 3 months ago and 3 months in the future
        $createdAt = $this->faker->dateTimeBetween('-3 months', '+3 months');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, '+3 months');

        return [
            'title'       => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(2),
            'tags'        => implode(',', $this->faker->words(5)),
            'content'     => $this->faker->paragraphs(5, true),
            'image'       => $this->faker->imageUrl(800, 600, 'business'),
            'is_published'=> $this->faker->boolean(80),
            'category_id' => Category::inRandomOrder()->value('id') ?? 1, // Get a random existing category ID
            'created_at'  => $createdAt,
            'updated_at'  => $updatedAt,
        ];
    }
}
