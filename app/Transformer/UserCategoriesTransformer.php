<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

use App\Category;


class UserCategoriesTransformer extends TransformerAbstract{




public function transform(Category $category){

      return
        [ 

      "id" => (int) $category->id,
      "name"=>$category->name,
      ];

}



}