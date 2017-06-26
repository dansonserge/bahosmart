<?php

namespace App\Customs;


use App\QuizSession;
use App\Pack;
use App\Category;
use App\Question;
use App\QuizSessionUserAnswer;
use App\QuizQuestion;
use App\QuizSessionQuestion;

use DB;

class Quiz{


public static function questionsMaker($quiz_session_id,$category_id,$number_of_questions){

       

$questions=Question::where('category_id',$category_id)->inRandomOrder()->take($number_of_questions)->with('answers')->get();
				

    


   $quizSessionQuestion=QuizSessionQuestion::where('quiz_session_id',$quiz_session_id)->count();

   $quiz_session=QuizSession::find($quiz_session_id);

  

       for($i=0;$i<$number_of_questions;$i++)
            {
               DB::table('quiz_session_questions')->insert([
                 [
                   'question_id' => $questions[$i]['id'], 
                   'quiz_session_id' =>$quiz_session_id,
                 ]
                ]); 
                 }

                 	return $questions;

  

       /*  for($i=0;$i<$number_of_questions;$i++)
            {
               DB::table('quiz_session_questions')->insert([
                 [
                   'quiz_session_id' =>$quiz_session_id,
                   'question_id' => $data[$i]['question_id'], 
                 ]
                ]);
                 
                
                 }
        */

     

      /*
			$quiz_session=QuizSession::find($quiz_session_id);

            $quizSessionQuestion=QuizSessionQuestion::where('quiz_session_id')->count();  
            
            if($quizSessionQuestion==0){
			 $quiz=$quiz_session->questions()->saveMany($questions);
            }*/


		

   }


  public function generateQuizReport($session_id){
   /* $userAnswers=QuizSessionUserAnswer::join('quiz_session','quiz_session.id','=','quiz_session_users_answers.quiz_session_id')                 ->join('questions','questions.id','=','quiz_session_users_answers.question_id')
		                 ->join('answers','answers.id','=','quiz_session_users_answers.answer_id')
		                 ->join('users','users.id','=','quiz_session_users_answers.user_id')
                         ->get();  */
  
  $userAnswers=QuizQuestion::join('quiz_session','quiz_session.id','=','quiz_session_questions.quiz_session_id')
		                      ->join('questions','questions.id','=','quiz_session_questions.question_id')
		                      ->where('quiz_session.id',$session_id)
		                      ->get();  


      


	return $userAnswers;

		 
     //return $userAnswers;
	}
  }