<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            ['name' => 'Nankatsu', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Toho', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Hanawa', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Furano', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Otomo', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Azumaichi', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Musashi', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Shutetsu', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Meiwa', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Nakahara', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Shimizu', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Shimada', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Hirado', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Naniwa', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
            ['name' => 'Minawi', 'budget' => 10000, 'wins' => 0, 'draws' => 0, 'losses' => 0],
        ]);
    }
}
