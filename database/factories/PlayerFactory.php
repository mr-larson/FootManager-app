<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\ja_JP\Person($this->faker));

        $positions = ['Forward', 'Midfielder', 'Defender', 'Goalkeeper'];
        $stats = [
            'speed' => $this->faker->numberBetween(30, 50),
            'stamina' => $this->faker->numberBetween(30, 50),
            'defense' => $this->faker->numberBetween(30, 50),
            'attack' => $this->faker->numberBetween(30, 50),
        ];

        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(10, 14),
            'position' => $this->faker->randomElement($positions),
            'cost' => $this->faker->numberBetween(1000, 5000),
            'stats' => json_encode($stats),
        ];
    }
}
