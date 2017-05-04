<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Hash;
use App\Transformer\CategoryTransformer;

use App\Transformer\UsersTransformer;
use App\Transformer\ExpertAccountApplications;
use App\Transformer\ExpertQuestions;
use App\Transformer\UserInfoTransformer;



use App\User;

use App\CategoryUser;
use App\Category;
use App\Follow;
use App\CategoryExpert;
use App\AdminExpert;
use App\Question;
use App\Answer;
use App\QuizQuestion;





class UserController extends Controller
{

	use Helpers;
  
  public function postSignup(Request $request){
  

    
     $validation= User::validate($request->all());

      if($validation->fails()){ 
        
        $errors=$validation->errors();
         return response()->json(['success'=>0,'failure'=>1,$errors],400);
      			
      }else{
        
        $user= new User;
        $user->first_name= $request->first_name;
        $user->last_name= $request->last_name;
        $user->email = $request->email;
        $user->password= Hash::make($request->password);
        $user->save();
        return response()->json(['success'=>1,'failure'=>0],200);
        
         
        }
     }

   public function postUserCategories(Request $request){

 //categories followed by this user 
  $category_ids=CategoryUser::where('user_id',$request->userid)->pluck('category_id')->toArray();
  
  $categories=Category::whereIn('id',$category_ids)->get();

  return response()->json($categories,200);
        

 }

 public function postCategories(Request $request){

      $categories=Category::where('active',1)->get();
      
     $user_id=$request->userid;


     
      return $this->response->collection($categories,new CategoryTransformer($user_id))->setStatusCode(200);


 }


 public function postFollowCategory(Request $request){

     $validation=CategoryUser::validate($request->all());
      if($validation->fails()){
   return response()->json(['category_msg'=>$validation->errors()],400);
 
      }
      else{
        $is_user_following_the_category=CategoryUser::where('user_id',$request->user_id)
                                        ->where('category_id',$request->category_id)->count();
     if( $is_user_following_the_category>0) {
                 $categoryuser=CategoryUser::where('user_id',$request->user_id)
                                           ->where('category_id',$request->category_id);

                $categoryuser->delete();

                 return response()->json(['followed'=>false,'category_id'=>$request->category_id],200);
                }           

                else{
                  $categoryuser= new CategoryUser;
                  $categoryuser->user_id=$request->user_id;
                  $categoryuser->category_id=$request->category_id;
                  $categoryuser->save();
            
                return response()->json(['followed'=>true,'category_id'=>$request->category_id],200);
          } 
      }
   }

   public function postFollowUsers(Request $request){

    $userid=$request->userid; 

    $logged_in_user=User::find($userid);

     $categoriesfollowedbythisuser=CategoryUser::where('user_id',$userid)->pluck('category_id')->toArray();
           
           //IDs OF USERS WHO FOLLOWED THE GIVEN CATEGORIES 
          $useridz= CategoryUser::whereIn('category_id', $categoriesfollowedbythisuser)->pluck('user_id')->toArray();

         $usersfollowed=Follow::where('user_id',$request->userid)->pluck('follows_user_id')->toArray();


          $users=User::whereIn('id',$useridz)->whereNotIn('id',$usersfollowed)->whereNotIn('id',[$userid])->get();

         return $this->response->collection($users,new UsersTransformer($userid))->setStatusCode(200);

   }
   public function postFollowUser(Request $request){

     $validation= Follow::validate($request->all());

      if($validation->fails()){ 
        return response()->json(['msg'=>$validation->errors()],400);

      }
      else{
              $is_following= Follow::where('user_id',$request->user_id)
                                      ->where('follows_user_id',$request->follows_user_id)->count();



                if($is_following>0) {
                 $following= Follow::where('user_id',$request->user_id)
                                      ->where('follows_user_id',$request->follows_user_id);

                $following->delete();

                $user_firstname =User::find($request->follows_user_id)->first_name;
                 $user_lastname =User::find($request->follows_user_id)->last_name;


                 return response()->json(['follow'=>false,'operation'=>-1,'msg'=>'You are no longer following '.$user_firstname.' '.$user_lastname],200);
                }           

                else{
                 $follow= new Follow;
                 $follow->user_id=$request->user_id;
                 $follow->follows_user_id=$request->follows_user_id;
                 $follow->save();

                 $user_firstname =User::find($request->follows_user_id)->first_name;
                 $user_lastname =User::find($request->follows_user_id)->last_name;


                 return response()->json(['follow'=>true,'operation'=>1,'msg'=>'You are following '.$user_firstname.' '.$user_lastname],200);

                    
                }          
             }

   }


   public function applyForExpertAccount(Request $request){

    $user= User::find($request->user_id);

    $user->telephone=$request->telephone;

    $user->save();

    $categoryExpert= new CategoryExpert;

     
     $catExpert= $categoryExpert->where('user_id',$request->user_id)->where('category_id',$request->category_id)->get();

     if($catExpert->count()>=1){

       return response()->json(['success'=>0,'failure'=>1,'msg'=>'You have already applied for the category.'],200);

      }else{

         $validation= CategoryExpert::validate($request->all());
      


      if($validation->fails()){ 
        
        $errors=$validation->errors();
         return response()->json(['success'=>0,'failure'=>1,$errors],400);
            
      }else{
        
      
        $categoryExpert->description=$request->description;
        $categoryExpert->educational_background=$request->educational_background;
        $categoryExpert->category_id=$request->category_id;
        $categoryExpert->user_id=$request->user_id;
        $categoryExpert->save();

        return response()->json(['success'=>1,'failure'=>0],200);
        }
     
       }

    
    }

   public function viewExpertAccountApplications(){
       $applications=CategoryExpert::where('status',0)->get();
   

        
    return $this->response->collection($applications,new ExpertAccountApplications())->setStatusCode(200);


   }

 public function confirmExpertAccount(Request $request){
 
     $categoryExpert= new CategoryExpert;
     $adminExpert= new adminExpert;

     $catExpert= $categoryExpert->where('user_id',$request->user_id)->where('category_id',$request->category_id)->get();
     

    if( $catExpert[0]->status==0){
      
        
       $categoryExpert=$categoryExpert->find($catExpert[0]->id);

       $categoryExpert->status=1;

       $categoryExpert->save();

       
        $adminExpert=AdminExpert::create(
         [
          'application_id'=>$catExpert[0]->id,
          'admin_id'=>$request->admin_id,
          'action'=>'confirm',
          'reason'=>'eligible'
          ]);

      
     $user=User::find($request->user_id);
     $user->status=1;
     $user->save();

     return response()->json(['success'=>1,'failure'=>0,'msg'=>$categoryExpert->status],200);



    }else if($catExpert[0]->status==1){

       $categoryExpert = $categoryExpert->find($catExpert[0]->id);
       $categoryExpert->status=0;

       $categoryExpert->save();

         $adminExpert=AdminExpert::create(
         [
          'application_id'=>$catExpert[0]->id,
          'admin_id'=>$request->admin_id,
          'action'=>'unconfirm',
          'reason'=>'not eligible'
         ]);

          $user=User::find($request->user_id);
         $user->status=0;
        $user->save();
     

     return response()->json(['success'=>1,'failure'=>0,'msg'=>$categoryExpert->status],200);
  
    }

 }
 public function addQuestions(Request $request){

   //check whether this user is an expert of this category

   $is_expert=CategoryExpert::where('category_id',$request->category_id)->where('user_id',$request->expert_id)->get()->count();
    if($is_expert<1){

         return response()->json(['success'=>0,'failure'=>1,'msg'=>'Not Allowed!'],400);
    }

  $validation= Question::validate($request->all());
      


      if($validation->fails()){ 
        
        $errors=$validation->errors();
         return response()->json(['success'=>0,'failure'=>1,$errors],400);
            
      }else{

     $question=new Question;

     $question->category_id=$request->category_id;
     $question->expert_id=$request->expert_id;
     $question->question_text=$request->question_text;
     $question->save();

     return response()->json(['success'=>1,'failure'=>0,'msg'=>'Question added successfully!'],200);
 }

 }

 public function addAnswer(Request $request){



    //check whether this user is owner of this question

    $is_question_owner=Question::where('id',$request->question_id)->where('expert_id',$request->expert_id)->get()->count();

    if( $is_question_owner<1){

         return response()->json(['success'=>0,'failure'=>1,'msg'=>'Not Allowed owner!'],400);


    }
$validation= Answer::validate($request->all());
      if($validation->fails()){ 
        
        $errors=$validation->errors();
         return response()->json(['success'=>0,'failure'=>1,$errors],400);
            
      }else{

         $number_of_answers=Answer::where('question_id',$request->question_id)->get()->count();
        

        //check whether answers are full
         if($number_of_answers>=4){

           return response()->json(['success'=>0,'failure'=>1,'msg'=>'Answers of the question are full'],200);
          
         }else{

           //if a user enters a true answer, check whether one answer is true
         if($request->is_correct==1){
               $one_is_true=Answer::where('question_id',$request->question_id)->where('is_correct',1)->get()->count();
                
                 if($one_is_true>=1){
         
                    return response()->json(['success'=>0,'failure'=>1,'msg'=>'One answer is already true, Verify your answers'],200);
                 }
                 else{

                    $answer=new Answer;
                    $answer->question_id=$request->question_id;
                    $answer->answer_text=$request->answer_text;
                    $answer->is_correct=$request->is_correct;
                    $answer->save();

                 }

           
         }
         else{


      $answer=new Answer;
      $answer->question_id=$request->question_id;
     $answer->answer_text=$request->answer_text;
     $answer->is_correct=$request->is_correct;
     $answer->save();
        return response()->json(['success'=>1,'failure'=>0,'msg'=>'Answer added successfully'],200);
         }
     }

  }



 }


 public function editQuestion(){

 }

 public function editAnswer(){

 }



 public function putQuestionLive(Request $request){

    //check whether this user is an expert of this category 
    $is_expert=CategoryExpert::where('category_id',$request->category_id)->where('user_id',$request->expert_id)->get()->count();
    if($is_expert<1){

         return response()->json(['success'=>0,'failure'=>1,'msg'=>'Not Allowed!'],400);
    }
    
    //check if is owner
    $is_question_owner=Question::where('id',$request->question_id)->where('expert_id',$request->expert_id)->get()->count();

      if( $is_question_owner<1){

         return response()->json(['success'=>0,'failure'=>1,'msg'=>'Not Allowed owner!'],400);
    }

     //check whether the question has 4 answers
   $number_of_answers=Answer::where('question_id',$request->question_id)->get()->count();


   if($number_of_answers!=4){

       $answers_left=4-$number_of_answers;
         return response()->json(['success'=>0,'failure'=>1,'msg'=>'Please add '.$answers_left.' more answers!'],400);

   }
   //check whether the question is not blocked

   $is_blocked=Question::find($request->question_id);

   if($is_blocked==6){

         return response()->json(['success'=>0,'failure'=>1,'msg'=>'the question is blocked'],400);


    }

    
    //check whether one and only one answer is true

   $one_is_true=Answer::where('question_id',$request->question_id)->where('is_correct',1)->get()->count();
    if($one_is_true!=1){

         return response()->json(['success'=>0,'failure'=>1,'msg'=>'At least one question must be true'],400);


    }

$question=Question::find($request->question_id);

$question->status=1;

$question->save();

return response()->json(['success'=>1,'failure'=>0,'msg'=>'The question is "Live" now!'],200);

}

 public function deleteQuestion(Request $request){

   //check if is owner
    $is_question_owner=Question::where('id',$request->question_id)->where('expert_id',$request->expert_id)->get()->count();

      if( $is_question_owner<1){

         return response()->json(['success'=>0,'failure'=>1,'msg'=>'Not Allowed owner!'],400);
    }



  //check whether the question has never been used
    $is_used=QuizQuestion::where('question_id',$request->question_id)->get()->count();

    if($is_used>1){
     $question=Question::find($request->question_id);
     $question->status=5;
     $question->save();
     }
     else{


  $question=Question::find($request->question_id);

  $answers=Answer::where('question_id',$request->question_id);

     $answers->delete();

     $question->delete();
    
    return response()->json(['success'=>1,'failure'=>0,'msg'=>'Question Successfully Deleted'],200);

       }
    }

    public function viewQuestions($expert_id){
      $questions=Question::where('expert_id',$expert_id)->where('status',0)->orWhere('status',1)->with('answers')->get();

    return $this->response->collection($questions,new ExpertQuestions)->setStatusCode(200);


    }


    public function myFollowers($user_id){
      //get ID's of users following this user

          $useridz= Follow::where('follows_user_id',$user_id)->pluck('user_id')->toArray();

          $users=User::whereIn('id',$useridz)->get();

          return $this->response->collection($users,new UserInfoTransformer)->setStatusCode(200);

    }

}
