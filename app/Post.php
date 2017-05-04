<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Post extends Model
{
   
   protected $fillable=array('category_id','user_id','title','post_text','deleted','image',);
   protected static $rules=array(
    'category_id'=>'required|integer',
    
    'title'=>'required|min:2',
    
    
    'post_text'=>'required',
    
    'image'=>'required|image|mimes:jpeg,jpg,bmp,png,gif'

   	);

   protected static function validate($data){
      return Validator::make($data, static::$rules);

    }


  
    public function likes(){
      return $this->hasMany('App\Like');
     }

   public function comments(){
    return $this->hasMany('App\Comment');
  }

   public function user(){
   	return $this->belongsTo('App\User');
   }
   public function category(){
    return $this->belongsTo('App\Category');
   }

   public function likedUsers(){
        return $this->belongsToMany('App\User','likes','post_id','user_id');
    }
  
}
