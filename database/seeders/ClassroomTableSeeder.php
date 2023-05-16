<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $grades=Grade::all();
        $classrooms=[
            [
                'en'=>'first',
                'ar'=>'الاول'
            ],
            [
                'en'=>'second',
                'ar'=>'الثاني'
            ],
            [
                'en'=>'third',
                'ar'=>'الثالث'
            ]
        ];
        foreach($grades as $grade){
            foreach($classrooms as $classroom){
                Classroom::create([
                    'name_class'=>[
                        'en'=>$classroom['en'],
                        'ar'=>$classroom['ar']
                    ],
                    'grade_id'=>$grade->id
                ]);
            }
        }
    }
}
