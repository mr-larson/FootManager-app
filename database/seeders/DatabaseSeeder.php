<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create a user test
        User::factory()->create([
            'name' => 'Gauthier',
            'email' => 'gauthierdewit@gmail.com',
            'password' => bcrypt('Password123'),
        ]);

        $this->call([
            TeamSeeder::class,
            PlayerSeeder::class,
            ContractSeeder::class,
        ]);

        //Player::factory(50)->create();
    }
}
