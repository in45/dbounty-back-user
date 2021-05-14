<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\CompanyManager;
use App\Models\Manager;
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
        $managers = Manager::all()->pluck('compte_address');
        foreach($companies as $companie){
            $rand = rand(0,count($managers)-1);
            $companie_manager = new CompanyManager();
            $companie_manager->company_id = $companie->id;
            $companie_manager->manager_address = $managers[$rand];
            $companie_manager->save();

        }
    }
}
