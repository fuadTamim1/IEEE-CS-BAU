<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{

    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_at_datetime = $this->faker->dateTimeBetween('-3 months', '+3 months');
        $end_at_datetime = $this->faker->dateTimeBetween($start_at_datetime, '+3 months');
        return [
            "title" => $this->faker->sentence(5),
            "tags" => implode(',', $this->faker->words(5)),
            "description" => $this->faker->paragraph(2),
            "status" => $this->faker->randomElement(["upcoming", "ongoing", "completed"]),
            "content" => $this->faker->paragraph(30),
            "image" => $this->faker->imageUrl(),
            "start_at" => $start_at_datetime,
            "end_at" => $end_at_datetime,
            "location" => $this->faker->randomElement(["amman", "zarqa", "online"]) 
        ];
    }
}
