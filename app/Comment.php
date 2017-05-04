<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Comment extends Model
{
   
   protected $fillable=array('user_id','post_id','text');
   
   protected static $rules=array(
     'user_id'=>'required|integer',
     'post_id'=>'required|integer',
     'text'=>'required'
    );

   protected static function validate($data){
      return Validator::make($data, static::$rules);

    }
   public function user(){
   	return $this->belongsTo('App\User');
   }

   public function post(){
   	return $this->belongsTo('App\Post');
   }
   
}