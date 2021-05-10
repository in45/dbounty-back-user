<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(CompanyManagerSeeder::class);
        $this->call(ProgramUserSeeder::class);
        $this->call(VulnerabilitySeeder::class);
        $this->call(ReportSeeder::class);
    }
}
