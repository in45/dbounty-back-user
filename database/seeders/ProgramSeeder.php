<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Program;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::truncate();

        $faker = Factory::create();
        $companies =  Company::all()->pluck('id');

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 80; $i++) {
            $begin_at = Carbon::now();
            $days = $faker->numberBetween(0,2);
            $hours = $faker->numberBetween(0,23);
            $description["info"] = $faker->realText(300,2);
            $rewards["p1"] = $faker->numberBetween($min = 10, $max = 100).'-'.$faker->numberBetween($min = 101, $max = 900);
            $rewards["p2"] = $faker->numberBetween($min = 10, $max = 100).'-'.$faker->numberBetween($min = 101, $max = 900);
            $rewards["p3"] = $faker->numberBetween($min = 10, $max = 100).'-'.$faker->numberBetween($min = 101, $max = 900);
            $rewards["p4"] = $faker->numberBetween($min = 10, $max = 100).'-'.$faker->numberBetween($min = 101, $max = 900);
            $rewards["p5"] = $faker->numberBetween($min = 10, $max = 100).'-'.$faker->numberBetween($min = 101, $max = 900);
            $description["rewards"] = $rewards;
            $finish_at = Carbon::now()->addDays($days)->addHours($hours);
            $company = $companies[rand(0,count($companies)-1)];
            DB::table('programs')->insert([
                'name' => 'DBounty'.$i,
                'company_id' =>$company,
                'type' =>  $faker->randomElement(['public','private','test']),
                'logo' =>  "http://via.placeholder.com/640x480.png/8F82A0?text=program",
                'status' => $faker->randomElement(['none','new','open','closed']),
                'min_bounty' =>$faker->numberBetween($min = 10, $max = 900),
                'max_bounty' =>$faker->numberBetween($min = 100, $max = 900),
                'begin_at' => $begin_at,
                'finish_at' => $finish_at,
                'range_response' =>$faker->numberBetween($min = 1, $max = 7),

                'description' => json_encode($description),
                'scopes' => $faker->realText(300,4),
                'rules' => $faker->realText(300,4),
                'conditions' => $faker->realText(300,4),
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
