<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizSession;
use App\Customs\Quiz;
use App\QuizSessionUserAnswer;
use DB;

use Illuminate\Support\Facades\Redis as LRedis;

use App\Transformer\QuizReportTransformer;


use Dingo\Api\Routing\Helpers;

use App\Category;
use App\Pack;

class ChallengeController extends Controller
{

    use Helpers;



  
    public function requestChallenge(Request $request){



     $category=Category::find($request->category_id);
     $pack=Pack::find($request->pack_id);

     $category_name=$category->name;
     $pack_name=$pack->name;
     $category_name=$category->name;

    $quizSession=new QuizSession;
    $quizSession->pack_id=$request->pack_id;
    $quizSession->category_id=$request->category_id;
    $quizSession->user_one_id=$request->user_one_id;
    $quizSession->user_two_id=$request->user_two_id;
    $quizSession->save();

/*
     return response()->json(['success'=>1,'failure'=>0,'msg'=>'Request sent!'],200);*/
     

   


     $data=[  
              'channel_type'=>'challenge_request',
              'quiz_session_id'=>$quizSession->id,
              'user_one_id'=>$request->user_one_id,
              'user_one_first_name'=>$request->user_one_first_name,
              'user_one_last_name'=>$request->user_one_last_name,
              'user_one_picture'=>$request->user_one_picture,
              
              'user_two_id'=>$request->user_two_id,
              'user_two_first_name'=>$request->user_two_first_name,
              'user_two_last_name'=>$request->user_two_last_name,
              'user_two_picture'=>$request->user_two_picture,

              'pack_id'=>$request->pack_id,
              'category_id'=>$request->category_id,
              'pack_name'=>$pack_name,
              'category_name'=>$category_name,
              'number_of_questions'=>$pack->questions,
              'status'=>0


           ];

      $redis = LRedis::connection();
  
      $redis->publish('RealTimeChannel',json_encode($data));
     
       
      return response()->json(['success'=>1,'failure'=>0,'msg'=>'hello'],200);
    
    }

    public function acceptRequest(Request $request){
     /*
        Required
        --------
          - Request ID 
          - User Two ID

        Processes
        ---------
       - Check whether the user is the user_two 
       - Change the status to 2 'meaning the request is accepted'
       - With socket.io change the UI asking the users to start Quiz
     */
    
    $is_user_two=QuizSession::where('user_two_id',$request->user_two_id)->get()->count();
    if($is_user_two<1){
     return response()->json(['success'=>0,'failure'=>1,'msg'=>'Not allowed!'],200);
     }

     $quiz=QuizSession::find($request->quiz_session_id);
     $quiz->status=2;
     $quiz->save();
  
     //Here return the object to the users in real-time with socket

      $data=[  
              'channel_type'=>'challenge_start_view',
              'quiz_session_id'=>$request->quiz_session_id,
              'user_one_id'=>$request->user_one_id,
              'user_one_first_name'=>$request->user_one_first_name,
              'user_one_last_name'=>$request->user_one_last_name,
              'user_one_picture'=>$request->user_one_picture,
              
              'user_two_id'=>$request->user_two_id,
              'user_two_first_name'=>$request->user_two_first_name,
              'user_two_last_name'=>$request->user_two_last_name,
              'user_two_picture'=>$request->user_two_picture,


              'pack_id'=>$request->pack_id,
              'category_id'=>$request->category_id,
              'pack_name'=>$request->pack_name,
              'category_name'=>$request->category_name,
              'number_of_questions'=>$request->number_of_questions,
              'status'=>0


           ];

      $redis = LRedis::connection();
  
      $redis->publish('RealTimeChannel',json_encode($data));

    
    return response()->json(['success'=>1,'failure'=>0,'msg'=>$data],200);


     
      
    }
 
 public function usersStartQuiz(Request $request){

      

        $quiz=QuizSession::find($request->quiz_session_id);
        $quiz->user_one_start=1;
        $quiz->save();


        $quizMaker = new Quiz;

      $questions=$quizMaker->questionsMaker($request->quiz_session_id,$request->category_id,$request->number_of_questions);

       
      $data=[  
              'channel_type'=>'challenge_view',

              'quiz_session_id'=>$request->quiz_session_id,
              'user_one_id'=>$request->user_one_id,
              'user_one_first_name'=>$request->user_one_first_name,
              'user_one_last_name'=>$request->user_one_last_name,
              'user_one_picture'=>$request->user_one_picture,
              
              'user_two_id'=>$request->user_two_id,
              'user_two_first_name'=>$request->user_two_first_name,
              'user_two_last_name'=>$request->user_two_last_name,
              'user_two_picture'=>$request->user_two_picture,


              'pack_id'=>$request->pack_id,
              'category_id'=>$request->category_id,
              'pack_name'=>$request->pack_name,
              'category_name'=>$request->category_name,
              'number_of_questions'=>$request->number_of_questions,
              'status'=>0,

              'questions'=>$questions,
             ];

      $redis = LRedis::connection();
  
      $redis->publish('RealTimeChannel',json_encode($data));

   return response()->json(['success'=>1,'failure'=>0,'msg'=>$questions],200);



    	/*
           Required
           ---------
             -Request ID 
             -User ID(USer 1 or User 2)

           Processes
           ---------
              - Check if the user is user 1. If so, update the user_one_start to 1
              
              - if both users have clicked the start button; using socket redirect them to the second screen and run the count down component. and therefore run the questions generator method.

    	*/


          /*    $quiz=QuizSession::find($request->quiz_id);

              $user_one=$quiz->user_one_id;
              $user_two=$quiz->user_two_id;
              
              $category_id=$quiz->category_id;
              $pack_id=$quiz->pack_id;


              
              $quizMaker = new Quiz;
                  
                   
               return $quizMaker->questionsMaker($request->quiz_id,$category_id,$pack_id);*/
    
               // Check whether the user is user 1
/*
             if($user_one == $request->user_id){

                	 $quiz->user_one_start=1;
                	 $quiz->save();
                        //check whether user two has clicked the start button
                	       if($quiz->user_two_start == 1){

                	            //generate questions into database

                      return $quizMaker->questionsMaker($request->quiz_id,$category_id,$pack_id);

                	         	//using socket.io change the user interface of the user

                	       }else{

                	       	return 'user two has not clicked START';
                       }

                  }else if($user_two == $request->user_id){

                	 $quiz->user_two_start=1;
                	 $quiz->save();
                        //check whether user one has clicked the start button
                	       if($quiz->user_one_start == 1){
                            
                	         
                	        //generate questions into database

                    return $quizMaker->questionsMaker($request->quiz_id,$category_id,$pack_id);


                	       	//using socket.io change the user interface of the user
                             

                	       }else{

                	       	return 'user one has not clicked START';
                       }
               }
              else{
           
             return response()->json(['success'=>0,'failure'=>1,'msg'=>'Not allowed!'],200);
              	
              }*/
         }



    public function usersQuizAnswers(Request $request){
            
            $userAnswer=new QuizSessionUserAnswer;
         

  


         $data = json_decode($request->quiz_answers, TRUE);

            for($i=1;$i<=count($data);$i++){
             
             DB::table('quiz_session_users_answers')->insert([
               [
                 'quiz_session_id' => $data['question_'.(string)$i]['quiz_session_id'], 
                 'user_id' => $data['question_'.(string)$i]['user_id'], 
                 'question_id' => $data['question_'.(string)$i]['question_id'], 
                 'answer_id' => $data['question_'.(string)$i]['answer_id']
               ],
              ]);
              
              
            }
           
           

    return response()->json(['success'=>1,'failure'=>0,'msg'=>'Data saved successfully!'],200);
           
          }



     public function quizReport($session_id){

      $quiz=new Quiz;
      $quiz->generateQuizReport($session_id);

       $report =$quiz->generateQuizReport($session_id);

     //return $report;


      return $this->response->collection($report,new QuizReportTransformer($session_id))->setStatusCode(200);


     }

}

































