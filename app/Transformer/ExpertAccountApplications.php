<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;
use App\CategoryExpert;

use App\User;

use App\Category;

class ExpertAccountApplications extends TransformerAbstract
{
	public function getUser($id){
  $user=User::find($id);
  return ['first_name'=>$user->first_name,'last_name'=>$user->last_name,'telephone'=>$user->telephone];

}

public function getCategory($id){

	$category=Category::find($id);

	return $category->name;

}

	
public function transform(CategoryExpert $categoryExpert){

      return
        [ 

      "id" => (int) $categoryExpert->id,
      "user"=>$this->getUser($categoryExpert->user_id),
      "status"=>$categoryExpert->status,
      "description"=>$categoryExpert->description,
      "educational_background"=>$categoryExpert->educational_background,
      "category"=>$categoryExpert->category_id,
      "time"=>$categoryExpert->created_at,
      "category"=>$this->getCategory($categoryExpert->category_id)
       ];

}




}


