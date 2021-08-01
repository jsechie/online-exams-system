<?php

use Illuminate\Database\Seeder;
use App\User;
class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 5; $i++) { 
        	$student = new User;
        	$user = $faker->firstName;
	        $student->name = $user." ".$faker->lastName;
	        $student->email = $user."1@gmail.com";
	        $student->password = bcrypt('@student');
	        $student->username = $user."1";
	        $student->index_number = rand(1,4)."".rand(1,4)."".rand(1,4)."".rand(1,4)."".rand(1,4)."".rand(1,4)."5";;
	        $student->student_id = "20".rand(1,4)."".rand(1,4)."".rand(1,4)."".rand(1,4)."".rand(1,4)."7";;
	        $student->dep_id = rand(1,3);
	        $student->year = rand(1,4);
	        $student->picture = 'public/77C1b71aGreCO1J4o5Oxn1xmFCZ9owWCGhAIGhcC.png';
	        if($i % 2 == 0){
                $student->student_type = 'Ghanaian';
            }
            else{
                $student->student_type = 'International';
            }
            if($i % 2 == 0){
                $student->program_type = "Regular";
            }
            else{
                $student->program_type = "Parallel";
            }
	        $student->save();
        }
        
    }
}
