<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Answer extends Model
{
    protected $table='answers';


     protected $fillable=array(
     	'question_id',
     	'answer_text',
     	'is_correct',
     	'status');
   
   protected static $rules=array(
     'question_id'=>'required|integer',
     'answer_text'=>'required',
     'is_correct'=>'required|boolean',
     
    );

   protected static function validate($data){
      return Validator::make($data, static::$rules);

    }
 public function questions(){
   	return $this->belongsTo('App\Question');
   }


}
