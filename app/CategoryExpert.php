<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CategoryExpert extends Model
{
    protected $table='category_expert';

    protected $fillable = [
        'category_id',
        'user_id',
        'description',
        'educational_background'
    ];

public static $rules = [
     'category_id'=>'required', 
     'user_id'=>'required', 
     'description'=>'required|min:10',
    'educational_background'=>'required'
  ];
   
protected static function validate($data){
        return Validator::make($data, static::$rules);

    
}

}
