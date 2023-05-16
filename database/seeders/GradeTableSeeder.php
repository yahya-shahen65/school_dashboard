<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();
        $grades=[
            [
                'en'=>'Primary Stage',
                'ar'=>'المرحله الابتدائيه'
            ],
            [
                'en'=>'Secondry Stage',
                'ar'=>'المرحله الاعداديه'
            ],
            [
                'en'=>"Hight School",
                'ar'=>'المرحله الثانويه'
            ],
            [
                'en'=>'University',
                'ar'=>'الجامعه'
            ],
        ];
        foreach($grades as $grade){
            Grade::create([
                'name'=>[
                    'en'=>$grade['en'],
                    'ar'=>$grade['ar']
                ]
            ]);
        }
    }
}
