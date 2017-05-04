<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Like extends Model
{

  protected $table='likes';
   
   protected $fillable=array('user_id','post_id');
   protected static $rules=array(
    'user_id'=>'required|integer',
    'post_id'=>'required|integer'

   	);

   protected static function validate($data){
      return Validator::make($data, static::$rules);

    }




}
