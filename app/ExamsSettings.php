<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamsSettings extends Model
{
    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id');
    }

    public function questions(){
    	return $this->hasMany('App\ExamsQuestions','exams_id');
    }
}
