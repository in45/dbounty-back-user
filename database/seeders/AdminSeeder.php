<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $faker = Factory::create();


        for ($i = 1; $i < 11; $i++) {
            DB::table('admins')->insert([
                'id'=>$faker->uuid,
                'email' => $faker->email,
                'password' => bcrypt("admin123"),
                'public_address'=>'0x'.Str::random(40),
                'username' => 'admin'.$i,
                'role' => $faker->randomElement(['sudo', 'sysmanage', 'sysmoni']),
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
