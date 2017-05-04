<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

use App\Comment;

use App\User;


class CommentsTransformer extends TransformerAbstract{


/*protected $defaultIncludes=['User'];

public function includeUser(Comment $comment){
   $user=$comment->users;

   dd($user);

}*/


public function getUser($id){
  $user=User::find($id);
  return array(['first_name'=>$user->first_name,'last_name'=>$user->last_name]);

}


public function transform(Comment $comment){
  return
      [ 
        "id"=> (int) $comment->id,
        "user_id"=> (int) $comment->user_id,
        "post_id"=>(int) $comment->post_id,
        "text"=>$comment->text,
        "created_at"=>$comment->created_at,
        "updated_at"=>$comment->updated_at,
        "user"=>$this->getUser($comment->user_id)
       
      ];
}


}