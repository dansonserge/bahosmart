<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

use App\User;


class UserInfoTransformer extends TransformerAbstract{

  public function transform(User $user){

	  	return [
			     'id'=>$user->id,
			     'first_name'=>$user->first_name,
			     'last_name'=>$user->last_name,
			     'profile_pic'=>$user->profile_picture
               ];

  }

}



