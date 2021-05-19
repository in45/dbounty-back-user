<?php

namespace Database\Seeders;

use App\Models\Manager;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::truncate();

        $faker = Factory::create();


        for ($i = 1; $i < 50; $i++) {
            DB::table('managers')->insert([
                'public_address'=>'0x'.Str::random(40),
                'first_name' => $faker->randomElement([$faker->firstNameMale,$faker->firstNameFemale]),
                'last_name' => $faker->lastName,
                'username' => $faker->name,
                'email' => $faker->email,
                'avatar' =>"http://via.placeholder.com/640x480.png/ffff00?text=manager".$i,
               'role' => $faker->randomElement(['sysalpha', 'sysbeta']),
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
