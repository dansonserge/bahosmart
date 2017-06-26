<?php

namespace App;

use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
   

   protected $fillable = [
        'firstname', 'lastname','email', 
        'password','telephone','user_type'
    ];

public static $rules = [
     'first_name'=>'required|min:2|regex:/^[\pL\s]+$/u', 
     'last_name'=>'required|min:2|regex:/^[\pL\s]+$/u', 
     'email'=>'required|email|unique:users', 
     'password'=>'required|min:6|confirmed',
     'password_confirmation'=>'required|min:6',
    'user_type'=>'integer'
  ];
   
protected static function validate($data){
        return Validator::make($data, static::$rules);

    
}

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function likes(){
    return $this->hasMany('App\Like');
  }
    public function post(){
        return $this->hasMany('App\Post');
    }
    public function follows(){
        return $this->hasMany('App\Follow');
    }
    public function categories(){
        return $this->belongsToMany('App\Categories');
    }

    public function likedPosts(){
        return $this->belongsToMany(
           'App\Post','likes','user_id','post_id'
            );
    }

     public function rooms(){
        return $this->belongsToMany('App\Room','rooms_users','user_id','room_id');
    }


    public function messages(){
        return $this->hasMany('App\Message');
    }

}
