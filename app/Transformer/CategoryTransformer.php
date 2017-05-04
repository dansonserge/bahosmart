<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

use App\Category;
use App\CategoryUser;


class CategoryTransformer extends TransformerAbstract{



protected $userId;

public function __construct($id){
return $this->userId=$id;
}

public function isFollowed($user_id,$category_id){

$is_followed=CategoryUser::where('user_id',$user_id)
        ->where('category_id',$category_id)->count();

        if($is_followed==0){

        	return false;

        }
        else{
        	return true;
        }

}
public function transform(Category $category){

      return
        [ 

      "id" => (int) $category->id,
      "name"=>$category->name,
      "active"=>$category->active,
      "followed"=>$this->isFollowed($this->userId,$category->id)

       ];

}




}