<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

use Dingo\Api\Routing\Helpers;

use App\Transformer\UserCategoriesTransformer;

use App\User;

use App\Follow;

use App\CategoryUser;

use App\Category;




class UsersTransformer extends TransformerAbstract{

  use Helpers;
protected $userId;

public function __construct($id){
return $this->userId=$id;
}

public function isFollowed($user_id,$followed_user_id){

$is_followed=Follow::where('user_id',$user_id)->where('follows_user_id',$followed_user_id)->count();

        if($is_followed==0){

        	return false;

        }
        else{
        	return true;
        }

}


public function following($user_id){

	$following=Follow::where('user_id',$user_id)->count();


	return (int) $following;

}


public function followers($user_id){

	$followers=Follow::where('follows_user_id',$user_id)->count();

	return (int) $followers;

}

public function interests($user_id){
   $category_ids=CategoryUser::where('user_id',$user_id)->pluck('category_id')->toArray();
  
    $categories=Category::whereIn('id',$category_ids)->get(['name','id']);
    
return $categories;

}



public function transform(User $users){

      return
        [ 

      "id" => (int)  $users->id,
      "first_name"=>$users->first_name,
      "last_name"=> $users->last_name,
      "profile_picture"=>$users->profile_picture,
      "telephone"=>$users->telephone,
      "email"=>$users->email,
      "status"=>$users->status,

      "followed"=>$this->isFollowed($this->userId,$users->id),


      "following"=>$this->following($users->id),

      "followers"=>$this->followers($users->id),

      "interests"=>$this->interests($users->id)

       ];

  }
}