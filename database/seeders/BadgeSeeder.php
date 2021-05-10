<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Badge::truncate();

        $faker = Factory::create();

        for ($i = 1; $i < 50; $i++) {

            DB::table('badges')->insert([
                'title' => $faker->title(),
                'avatar' => "http://via.placeholder.com/640x480.png/008811?text=badge",
                'description' => $faker->realText(200),
                'tokens'=>  $faker->numberBetween($min = 10, $max = 900),
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
