<?php

namespace App;

Use App\Course;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function courses()
    {
    	return $this->hasMany(Course::class,'dep_id');
    }

    public function students(){
        return $this->hasMany(User::class,'dep_id');
    }
}
