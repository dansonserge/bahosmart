<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Question extends Model
{
    protected $table='questions';


     protected $fillable=array('category_id','expert_id','question_text');
   
   protected static $rules=array(
     'category_id'=>'required|integer',
     'expert_id'=>'required|integer',
     'question_text'=>'required'
    );

   protected static function validate($data){
      return Validator::make($data, static::$rules);

    }
 public function answers(){
   	return $this->hasMany('App\Answer');
   }

    public function quizSessions(){
      return $this->belongsToMany('App\QuizSession','quiz_session_questions','question_id','quiz_session_id');
    }

}
