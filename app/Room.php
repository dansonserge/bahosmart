<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
     public function users(){
        return $this->belongsToMany('App\User','rooms_users','room_id','user_id');
    }


     public function messages(){
        return $this->hasMany('App\Message');
    }
}
