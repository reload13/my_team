<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Clear existing records from the table
        DB::table('games')->delete();

        // Insert sample data using Faker
        $teams = DB::table('teams')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $homeTeamId = $faker->randomElement($teams);
            $awayTeamId = $faker->randomElement(array_diff($teams, [$homeTeamId]));

            DB::table('games')->insert([
                'date' => $faker->dateTimeThisMonth,
                'time' => $faker->time,
                'location' => $faker->city,
                'home_team_id' => $homeTeamId,
                'away_team_id' => $awayTeamId,
                'score' => $faker->optional()->numberBetween(0, 5) . '-' . $faker->optional()->numberBetween(0, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
