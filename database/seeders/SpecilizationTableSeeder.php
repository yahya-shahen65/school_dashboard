<?php

namespace Database\Seeders;

use App\Models\specilization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SpecilizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specilizations')->delete();
        $specilizations=[
            [
                'en'=>'Arabic',
                'ar'=>'عربي'
            ],
            [
                'en'=>'English',
                'ar'=>'انجليزي'
            ],
            [
                'en'=>'Computer science',
                'ar'=>'علوم حاسب'
            ],
            [
                'en'=>'Science',
                'ar'=>'علوم'
            ],
            [
                'en'=>'AI',
                'ar'=>'ذكاء اصطناعي'
            ]
        ];
        foreach($specilizations as $specilization){
            specilization::create([
                'name'=>$specilization
            ]);
        }
    }
}
