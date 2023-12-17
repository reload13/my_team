<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Clear existing records from the table
        DB::table('teams')->delete();

        // Insert sample data using Faker
        for ($i = 0; $i < 10; $i++) {
            DB::table('teams')->insert([
                'name' => $faker->company,
                'logo' => $faker->imageUrl(200, 200, 'sports'), // Generate a placeholder image URL
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
