<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;


use App\QuizQuestion;
use App\Answer;

use App\QuizSessionUserAnswer;



class QuizReportTransformer extends TransformerAbstract{


    protected $session_id;
	
	public function __construct($id){
          
         return $this->session_id=$id;
	
	}

	public function getUsersAnswers($session_id,$question_id){

     $userAnswers=QuizSessionUserAnswer::join('quiz_session','quiz_session.id','=','quiz_session_users_answers.quiz_session_id')
		                          ->join('questions','questions.id','=','quiz_session_users_answers.question_id')
		                          ->join('answers','answers.id','=','quiz_session_users_answers.answer_id')
					              ->join('users','users.id','=','quiz_session_users_answers.user_id')
					              ->where('quiz_session.id',$session_id)
					              ->where('questions.id',$question_id)
			                      ->get();

        return $this->response->collection($userAnswe,new QuizSessionUserAnswerTransformer)->setStatusCode(200);

                         return $userAnswers;

 }

public function getAnswer($question_id){

      $answer=Answer::where('question_id',$question_id)->where('is_correct',1)->first();
        //return $this->collection($answer,new AnswersTransformer);
      return $answer;
   
    }
public function transform(QuizQuestion $report){

      return
        [ 
          "id" => (int) $report->id,
          "question_text"=>$report->question_text,
          "real_answer"=>$this->getAnswer($report->id),
          "users_answers"=>$this->getUsersAnswers($this->session_id,$report->id)
       ];

    }
  }