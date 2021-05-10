<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\CompanyManager;
use App\Models\User;
use Faker\Factory;

class CompanyManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        CompanyManager::truncate();
        $faker = Factory::create();
        $companies = Company::all();
        $users = User::all()->pluck('compte_address');
        foreach($companies as $companie){
            $rand = rand(0,count($users)-1);
            $companie_manager = new CompanyManager();
            $companie_manager->company_id = $companie->id;
            $companie_manager->manager_address = $users[$rand];
            $user = User::where('compte_address',$users[$rand])->first();
            $user->role = $faker->randomElement(['sysalpha', 'sysbeta']);
            $user->save();
            $companie_manager->save();

        }
    }
}
