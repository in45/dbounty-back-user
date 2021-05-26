<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = Factory::create();


        for ($i = 1; $i < 100; $i++) {
            DB::table('users')->insert([
                'id'=>$faker->uuid,
                'email' => $faker->email,
                'password' => bcrypt("user123"),
                'public_address'=>'0x'.Str::random(40),
                'first_name' => $faker->randomElement([$faker->firstNameMale,$faker->firstNameFemale]),
                'last_name' => $faker->lastName,
                'username' => $faker->name,
                'avatar' =>"http://via.placeholder.com/640x480.png/14C9AC?text=hunter".$i,
                'score' =>$faker->numberBetween(100,5000),
                'country' =>$faker->country,
                'phone' => $faker->e164PhoneNumber,
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
