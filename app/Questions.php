<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id');
    }
}
