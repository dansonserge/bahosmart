<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Follow extends Model
{
    protected $fillable=array('user_id','follows_user_id');
   protected static $rules=array(
   'user_id'=>'required|integer',
    'follows_user_id'=>'required|integer'
     );

    protected static function validate($data){
      return Validator::make($data, static::$rules);

    }
    
   public function user(){
   	return $this->belongsTo('User');
   }
 }
