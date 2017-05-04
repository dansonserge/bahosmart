<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;
use App\Post;
use App\User;
use App\Comment;
use App\Like;


class PostTransformer extends TransformerAbstract{

protected $user_id;

public function __construct($user_id){
  $this->user_id=$user_id;
}

protected $defaultIncludes=['Comments','Likes'];

public function includeComments(Post $post){
   $comments=$post->comments;

   return $this->collection($comments,new CommentsTransformer);

}

public function includeLikes(Post $post){

  $likes=$post->likedUsers;

   return $this->collection($likes,new UserInfoTransformer );


}


public function did_i_like($user_id,$post_id){

$is_liked= Like::where('user_id',$user_id)
                                    ->where('post_id',$post_id)->count();


                       if($is_liked>0){
                       

                          return true;
          }
                        else{
                  return false;
     }
}

public function did_i_dislike($user_id,$post_id){

$is_liked= Like::where('user_id',$user_id)
                                    ->where('post_id',$post_id)->count();


                       if($is_liked==0){
                       

                          return true;
          }
                        else{
                  return false;
     }
}



public function likesCounter($post_id){
  /*$post=new Post;

  $likesnumber= $post->likedUsers->count();*/

   $likes_number= Like::where('post_id',$post_id)->count();

  return (int) $likes_number;

}


public function transform(Post $post){

      return
        [ 

      "id"=> (int) $post->id,
      "user_id"=>(int) $post->user_id,
      "category_id"=>(int) $post->user_id,
      "title"=>$post->title,
      "post_text"=>$post->post_text,

      "image"=> $post->image,
      "deleted"=> 0,
      "created_at"=> $post->created_at,
      "updated_at"=>$post->updated_at,
      "did_i_like"=>$this->did_i_like($this->user_id,$post->id),
      "did_i_dislike"=>$this->did_i_dislike($this->user_id,$post->id),
      "likes_number"=>$this->likesCounter($post->id)
      

       ];

}




}