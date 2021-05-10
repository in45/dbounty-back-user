<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Company::truncate();

        $faker = Factory::create();

        for ($i = 1; $i < 50; $i++) {

            DB::table('companies')->insert([
                'name' => $faker->company,
                'logo' => "http://via.placeholder.com/640x480.png/00bfff?text=company",
                'website' => $faker->url,
                'alpha_code' => substr(strtoupper(chunk_split(Str::random(16), 4, '-')),0,-1),
                'beta_code' => substr(strtoupper(chunk_split(Str::random(16), 4, '-')),0,-1),
                'email' => $faker->email,
                'phone' => $faker->e164PhoneNumber,
                'description'=>  $faker->Realtext(30),
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
