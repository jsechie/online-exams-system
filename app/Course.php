<?php

namespace App;
use App\Academic;
use App\Questions;
use App\Admin;
Use App\Department;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function departments()
    {
    	return $this->belongsTo(Department::class,'dep_id');
    }

    public function academics(){
    	return $this->belongsTo(Academic::class,'academics_id');
    }

    public function questions(){
    	return $this->hasMany(Questions::class,'course_id');
    }

    public function users(){
    	return $this->belongsTo(Admin::class,'assigned_to');
    }
}
