<?php

use Illuminate\Database\Seeder;
use App\Department;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = new Department;
        $department->name ='Computer Science';
        $department->code ='086';
        $department->save();

        $department = new Department;
        $department->name ='Mathematics';
        $department->code ='087';
        $department->save();

        $department = new Department;
        $department->name ='Biological Science';
        $department->code ='089';
        $department->save();

        $department = new Department;
        $department->name ='Chemistry';
        $department->code ='090';
        $department->save();
    }
}
