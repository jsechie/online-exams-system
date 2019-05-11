<?php

use Illuminate\Database\Seeder;
use App\Academic;
class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$academic = new Academic;
        $academic->year = "2018/2019";
        $academic->semester = "1";
        $academic->save();

        $academic = new Academic;
        $academic->year = "2018/2019";
        $academic->semester = "2";
        $academic->status = "1";
        $academic->save();
    }
}
