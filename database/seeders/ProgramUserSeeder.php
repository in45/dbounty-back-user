<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramUser;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProgramUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        ProgramUser::truncate();
        $programs = Program::all()->pluck('id');
        $users = User::all()->pluck('id');

        $faker = Factory::create();

        for ($i = 0; $i < 40; $i++) {
            $rand_prog = rand(0,count($programs)-1);
            $rand_user = rand(0,count($users)-1);
            DB::table('program_users')->insert([
                'prog_id' => $programs[$rand_prog],
                'user_id' => $users[$rand_user],
                'thanks' => $faker->randomElement(['0','1']),
                'accept_inv' => $faker->randomElement(['0','1']),
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
