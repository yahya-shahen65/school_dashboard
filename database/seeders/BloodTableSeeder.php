<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blood;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Blood::all()->delete();
        DB::table('bloods')->delete();
        $bloods= ['O-', 'O+', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
        foreach($bloods as $blood){
            Blood::Create([
                'name'=>$blood
            ]);
        }
    }
}
