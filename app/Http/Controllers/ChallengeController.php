<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizSession;
use App\Customs\Quiz;
use App\QuizSessionUserAnswer;
use DB;
use App\QuizQuestion;
use Illuminate\Support\Facades\Redis as LRedis;

use App\Transformer\QuizReportTransformer;

use App\User;


use Dingo\Api\Routing\Helpers;

use App\Category;
use App\Pack;

use App\Question;

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
              'status'=>0];

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


         }



    public function usersQuizAnswers(Request $request){
            
         $userAnswer=new QuizSessionUserAnswer;
         
       
         
         $j=(int) $request->number_of_questions;


            for($i=0;$i<$j;$i++)
            {
               DB::table('quiz_session_users_answers')->insert([
                 [
                   'quiz_session_id' => $request->quiz_answers[$i]['quiz_session_id'], 
                   'user_id' => $request->quiz_answers[$i]['user_id'], 
                   'question_id' => $request->quiz_answers[$i]['question_id'], 
                   'answer_id' => $request->quiz_answers[$i]['answer_id']?$request->quiz_answers[$i]['answer_id']:null,
                   'status'=>$request->quiz_answers[$i]['is_correct']
                 ]
                ]);
             }
            
            $user=User::find($request->quiz_answers[0]['user_id']);

          $data=[  
              'channel_type'=>'answers',

             'answers_from_server'=>$request->quiz_answers,
             'user'=>$user
              
             ];

          $redis = LRedis::connection();
  
      $redis->publish('RealTimeChannel',json_encode($data));


        return response()->json(['success'=>1,'failure'=>0,'msg'=> $request->quiz_answers],200);
           
          

          }



     public function quizReport($session_id){

            /*$quiz=new Quiz;
            $quiz->generateQuizReport($session_id);

             $report =$quiz->generateQuizReport($session_id);

           


            return $this->response->collection($report,new QuizReportTransformer($session_id))->setStatusCode(200);*/


/*
        $userAnswers=QuizSessionUserAnswer::

        join('quiz_session','quiz_session.id','=','quiz_session_users_answers.quiz_session_id')
     
      ->join('questions','questions.id','=','quiz_session_users_answers.question_id')
     
      ->join('users','users.id','=','quiz_session_users_answers.user_id')
      
      ->where('quiz_session.id',$session_id)
     
      ->get();*/


/*$userAnswers=Question::join('questions.id','=','quiz_session_users_answers.question_id')
->join('quiz_session','quiz_session.id','=','quiz_session_users_answers.quiz_session_id')

->where('quiz_session.id',$session_id)

->get();
                      
*/

/*$userAnswers=DB::table('questions')
->join('quiz_session_users_answers','questions.id','=','quiz_session_users_answers.question_id')
->join('quiz_session','quiz_session.id','=','quiz_session_users_answers.quiz_session_id')
->where('quiz_session_id',$session_id)
->get();
*/


//$username = DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')->where('users.id', '=', '1')


       
/*$userAnswers=DB::table('questions')
->join('quiz_session_users_answers','questions.id','=','quiz_session_users_answers.question_id')
->join('quiz_session','quiz_session.id','=','quiz_session_users_answers.quiz_session_id')
->where('quiz_session_id',$session_id)
->get();*/


   $userAnswers=QuizQuestion::join('quiz_session','quiz_session.id','=','quiz_session_questions.quiz_session_id')
                            ->join('questions','questions.id','=','quiz_session_questions.question_id')
                            ->join('packs','packs.id','=','quiz_session.pack_id')
                            ->join('categories','categories.id','=','quiz_session.category_id')
                            ->where('quiz_session.id',$session_id)
                            ->get();  


  return $this->response->collection($userAnswers,new QuizReportTransformer($session_id))->setStatusCode(200);


           

        

     }

}

































