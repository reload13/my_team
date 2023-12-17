<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PlayersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Clear existing records from the table
        DB::table('players')->delete();

        // Insert sample data using Faker
        for ($i = 0; $i < 10; $i++) {
            DB::table('players')->insert([
                'name' => $faker->name,
                'photo' => $faker->imageUrl(200, 200, 'people'), // Generate a placeholder image URL
                'position' => $faker->randomElement(['Forward', 'Midfielder', 'Defender', 'Goalkeeper']),
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

