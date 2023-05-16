<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


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
        $this->call(BloodTableSeeder::class);
        $this->call(ReligionTableSeeder::class);
        $this->call(NationalitieTableSeeder::class);
        $this->call(GradeTableSeeder::class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(SpecilizationTableSeeder::class);
    }
}
