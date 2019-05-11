<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$examiner = new Admin;
        $examiner->lec_id = '000001';
        $examiner->username = 'examiner1';
        $examiner->name = 'examiner';
        $examiner->email = 'examiner@gmail.com';
        $examiner->role = 'Examiner';
        $examiner->password = bcrypt('examiner');

        $examiner->save();
    }
}
