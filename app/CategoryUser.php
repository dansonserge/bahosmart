<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CategoryUser extends Model
{
    protected $fillable=array('user_id','category_id');
   protected static $rules=array('user_id'=>'required|integer','category_id'=>'required|integer');

   protected static function validate($data){
      return Validator::make($data, static::$rules);
       }

   public function user(){
   	return $this->belongsTo('App\User');

   }

   public function category(){
    return $this->belongsTo('App\Category');
    
   }


   
}
