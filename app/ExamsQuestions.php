<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamsQuestions extends Model
{
    //this handles the lecturers exam questions in the database
    public function exams()
    {
    	return $this->belongsTo('App\ExamsSettings','exams_id');
    }

    public function questions()
    {
    	return $this->belongsTo('App\Questions','question_id');
    }
}
