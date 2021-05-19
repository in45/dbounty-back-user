<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Report;
use App\Models\User;
use App\Models\Vulnerability;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Report::truncate();
        $programs = Program::all()->pluck('id');
        $vulns = Vulnerability::all()->pluck('id');
        $users = User::all()->pluck('public_address');

        $faker = Factory::create();

        for ($i = 0; $i < 60; $i++) {
            $rand_prog = rand(0,count($programs)-1);
            $rand_vuln = rand(0,count($vulns)-1);
            $rand_user = rand(0,count($users)-1);
            DB::table('reports')->insert([
                'title' => 'Program'.$i.'_'.Carbon::now()->format('Y-m-d H:i:s'),
                'target' => $faker->randomElement([$faker->domainName,$faker->ipv4]),
                'vuln_id' => $vulns[$rand_vuln],
                'user_address' => $users[$rand_user],
                'prog_id' => $programs[$rand_prog],
                'vuln_name' => $faker->text($maxNbChars = 20),
                'vuln_details' => $faker->text($maxNbChars = 50),
                'validation_steps' => $faker->text,
                'severity' => $faker->randomElement(['low','medium','high','critical']),
                'status' => $faker->randomElement(['new', 'needs more info', 'triaged', 'accepted', 'resolved', 'duplicate', 'informative', 'not applicable']),
                'bounty_win' => $faker->numberBetween($min = 100, $max = 9000),
                'created_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::now()->format('Y-m-d H:i:s')
            ]);

        }
    }
}
