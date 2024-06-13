<?php

namespace Database\Factories;

use App\Constants\ComplaintStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComplaintFactory extends Factory
{
    public function definition(): array
    {
        $statuses = ComplaintStatus::all()->toArray();

        return [
            'ulid' => (string) Str::ulid(),
            'reporter_role' => $this->faker->randomElement(['Korban', 'Teman', 'Tetangga', 'Keluarga']),
            'ktp' => 'ktp.png',
            'category' => $this->faker->randomElement(['Category 1', 'Category 2', 'Category 3']),
            'status' => $this->faker->randomElement($statuses),
            'description' => $this->faker->paragraph,
            'location' => $this->faker->address,
            'incident_date' => $this->faker->date,
            'incident_time' => $this->faker->time,
        ];
    }
}
