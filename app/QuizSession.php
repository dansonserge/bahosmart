<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
   protected $table='quiz_session';
    
    public function questions(){
        return $this->belongsToMany('App\Question','quiz_session_questions','quiz_session_id','question_id');
    }
}
