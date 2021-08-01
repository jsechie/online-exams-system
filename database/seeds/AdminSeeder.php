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
        $examiner->username = 'admin';
        $examiner->name = 'admin';
        $examiner->email = 'admin@gmail.com';
        $examiner->role = 'Examiner';
        $examiner->password = bcrypt('admin123');

        $examiner->save();
    }
}
