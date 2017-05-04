<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminExpert extends Model
{
    
  protected $table='admin_expert';

    protected $fillable = [
       
        'admin_id',
        'action',
        'reason',
        'application_id'
    ];
}
