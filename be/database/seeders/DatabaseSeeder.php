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
        $this->call([
            AdminAccountSeeder::class,
            CollegeSeeder::class,
            CourseSeeder::class,
            OrganizationServicesSeeder::class,
            OrganizationSeeder::class,
            SectionSeeder::class,
        ]);
    }
}
