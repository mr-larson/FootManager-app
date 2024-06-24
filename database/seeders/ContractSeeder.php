<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define teams and their corresponding players
        $teamsPlayers = [
            'Nankatsu' => ['Morisaki', 'Tsuboi', 'Ishizaki', 'Nakazato', 'Nagano', 'Okawa', 'Sakurai', 'Ozora', 'Misaki', 'Oda', 'Iwami', 'Minowa', 'Murashige'],

            'Toho' => ['Wakashimazu', 'Furuta', 'Kawabe', 'Takashima', 'Imai', 'Koike', 'Matsuki', 'Sawada', 'Shimano', 'Hyuga', 'Sorimachi'],

            'Hanawa' => ['Yoshikura', 'Koda', 'Murasawa', 'Nakamura', 'Daimaru', 'Shiota', 'Aimoto', 'Tamai', 'Tachibana', 'Ono'],

            'Furano' => ['Kato', 'Honda', 'Kondo', 'Kamata', 'Matsuda', 'Kaneda', 'Matsuyama', 'Wakamatsu', 'Nakagawa', 'Oda', 'Yamamuro'],

            'Otomo' => ['Ichijo', 'Yoshikawa', 'Nishio', 'Nakayama', 'Kawada', 'Hiraoka', 'Kishida', 'Urabe', 'Tadami', 'Nakao', 'Nitta'],

            'Azumaichi' => ['Tsuji', 'Soda', 'Yamada', 'Sasaki', 'Hayashi', 'Yoshida', 'Kuramochi', 'Nakai', 'Onodera', 'Ide', 'Mihashi'],

            'Musashi' => ['Moriyama', 'Kido', 'Mukai', 'Sano', 'Suzuki', 'Yoshida', 'Inoue', 'Misugi', 'Ichinose', 'Honma', 'Sanada'],

            'Shutetsu' => ['Wakabayashi', 'Takasugi', 'Shimada', 'Matsumo', 'Nakamoto', 'Kurata', 'Osaki', 'Inamura', 'Izawa', 'Kisugi', 'Taki'],

            'Meiwa' => ['Murasawa', 'Kawagoe', 'Ishii', 'Takagi', 'Nagano', 'Sakamoto', 'Narita', 'Hori', 'Enomoto', 'Sawaki', 'Suenaga'],

            'Nakahara' => ['Kawakami', 'Masumoto', 'Haranashi', 'Fujita', 'Toda', 'Nagatani', 'Harukawa', 'Itao', 'Kurita', 'Asada', 'Aoi'],

            'Shimizu' => ['Kawakami', 'Kudo', 'Kanda', 'Ibaraki', 'Suzuki', 'Takada', 'Nakao', 'Iimura', 'Murakami', 'Kato', 'Obayashi'],

            'Shimada' => ['Nagai', 'Ito', 'Fujisawa', 'Takahashi', 'Kimura', 'Ishikawa', 'Hashimoto', 'Nagasaki', 'Nakamura', 'Jinbo', 'Wesugi'],

            'Hirado' => ['Hatakeyama', 'Soda', 'Jito', 'Akizawa', 'Noda', 'Nagaoka', 'Nakajo', 'Morisue', 'Takeno', 'Himeji', 'Sano'],

            'Naniwa' => ['Nakanishi', 'Tsusaki', 'Kosaka', 'Yoshimoto', 'Tennoji', 'Dojima', 'Maeda', 'Shirai', 'Ogami', 'Takayanagi', 'Marui'],

            'Minawi' => ['Asakura', 'Azuma', 'Takahama', 'Kawanoe', 'Iyo', 'Tosa', 'Shintani', 'Ishida', 'Hirayama', 'Seto', 'Takei'],
        ];

        $contracts = [];

        foreach ($teamsPlayers as $teamName => $playerLastnames) {
            // Retrieve the team ID
            $teamId = DB::table('teams')->where('name', $teamName)->value('id');

            // Retrieve the player IDs for the current team's players
            $playerIds = DB::table('players')
                ->whereIn('lastname', $playerLastnames)
                ->pluck('id')
                ->toArray();

            // Create contracts for the players
            foreach ($playerIds as $playerId) {
                $contracts[] = [
                    'team_id' => $teamId,
                    'player_id' => $playerId,
                    'salary' => rand(100, 1000), // Example salary range
                    'start_date' => Carbon::now()->format('Y-m-d'),
                    'end_date' => Carbon::now()->addYear()->format('Y-m-d'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
        }

        DB::table('contracts')->insert($contracts);
    }
}
