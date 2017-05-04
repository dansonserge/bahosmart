<?php

namespace App\Customs;


use App\QuizSession;
use App\Pack;
use App\Category;
use App\Question;
use App\QuizSessionUserAnswer;
use App\QuizQuestion;

class Quiz{


public static function questionsMaker($quiz_session_id,$category_id,$number_of_questions){

       

   
				$questions=Question::where('category_id',$category_id)->inRandomOrder()->take($number_of_questions)->with('answers')->get();
					
				/*$quiz_session=QuizSession::find($quiz_session_id);

				$quiz=$quiz_session->questions()->saveMany($questions);
				*/

			//$questions=Question::whereIn('id',[23,13,40,35,46])->get();

			$quiz_session=QuizSession::find($quiz_session_id);

			$quiz=$quiz_session->questions()->saveMany($questions);

			return $questions;

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