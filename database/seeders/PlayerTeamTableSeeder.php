<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PlayerTeamTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Clear existing records from the table
        DB::table('player_team')->delete();

        // Insert sample data using Faker
        $players = DB::table('players')->pluck('id')->toArray();
        $teams = DB::table('teams')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $playerId = $faker->randomElement($players);
            $teamId = $faker->randomElement($teams);

            DB::table('player_team')->insert([
                'player_id' => $playerId,
                'team_id' => $teamId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

