<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests;
use App\Post;
use App\PostImage;
use Auth;
use App\User;
use App\Like;
use App\Comment;
use App\Follow;

use App\Transformer\PostTransformer;


use Intervention\Image\Facades\Image as Image;
class PostController extends Controller{
  use Helpers;

public function postNewPost(Request $request){

        $user=User::find($request->user_id);

    	  $validation= Post::validate($request->all());

          if($validation->fails()){ 
        
        $errors=$validation->errors();
        
         return response()->json(['success'=>0,'failure'=>1,$errors],400);
      			
      }
      
      else{


          $post=new Post;
          $post->title=$request->title;
          $post->post_text=$request->post_text;

          $image = $request->file('image');

          $filename  = time() . '.' . $image->getClientOriginalExtension();
          $path = public_path('images/posts/' . $filename);
         
          Image::make($image->getRealPath())->resize(498,498)->save($path);
          $post->image = 'images/posts/'.$filename;
          $post->post_text=$request->post_text;
          $post->category_id=$request->category_id;

        
          $user->post()->save($post);

          return response()->json(['success'=>1,'failure'=>0],200);
        
      }
   }

   public function postNewComment(Request $request){

         $post= Post::find($request->post_id);

        $validation= Comment::validate($request->all());

          if($validation->fails()){ 
        
        $errors=$validation->errors();
        
         return response()->json(['success'=>0,'failure'=>1,$errors],400);
            
      }
      else{

           $comment=new Comment();
           
           $comment->user_id=$request->user_id;
         
           $comment->text=$request->text;
           
           $post->comments()->save($comment);
           
           return response()->json(['success'=>1,'failure'=>0],200);
          }
        }

     public function getPosts($user_id){
        $posts=Post::where('user_id',$user_id)->where('deleted',0)->with('comments','likes')->get();
        return $this->response->collection($posts,new PostTransformer($user_id))->setStatusCode(200);

        }


        public function getFeeds($user_id){

           $usersfollowed=Follow::where('user_id',$user_id)->pluck('follows_user_id')->toArray();
         
           $feeds=Post::whereIn('user_id',$usersfollowed)->get();

           return $this->response->collection($feeds,new PostTransformer($user_id))->setStatusCode(200);
           
       }

        public function postLike(Request $request){

          $validation=Like::validate($request->all());
          if($validation->fails()){
             $errors=$validation->errors();
             return response()->json(['success'=>0,'failure'=>1,$errors],400);
          }
            else{

                   $is_liked= Like::where('user_id',$request->user_id)
                                    ->where('post_id',$request->post_id)->count();


                       if($is_liked>0){
                        $liked=Like::where('user_id',$request->user_id)
                                    ->where('post_id',$request->post_id);
                         $liked->delete();

                          return response()->json(['success'=>1,'failure'=>0,'like'=>false],200);


                       }
                        else{
                             
                             $liking= new Like;
                             $liking->user_id=$request->user_id;
                             $liking->post_id=$request->post_id;
                             $liking->save();
                       
                          return response()->json(['success'=>1,'failure'=>0,'like'=>true],200);
                    }
                 }
              }

          public function getSinglePost($post_id,$user_id){

            $post=Post::where('id',$post_id)->get();

           return $this->response->collection($post,new PostTransformer($user_id))->setStatusCode(200);
      }
    }
