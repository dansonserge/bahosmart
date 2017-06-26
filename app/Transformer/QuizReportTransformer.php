<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;


use App\QuizQuestion;
use App\Answer;

use App\QuizSessionUserAnswer;

use Dingo\Api\Routing\Helpers;

class QuizReportTransformer extends TransformerAbstract{

use Helpers;

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

        //return $this->response->collection($userAnswers,new QuizSessionUserAnswerTransformer)->setStatusCode(200);

                         return $userAnswers;

 }

public function getAnswer($question_id){

      $answer=Answer::where('question_id',$question_id)->where('is_correct',1)->first();
        //return $this->collection($answer,new AnswersTransformer);
      return $answer;
   
    }


public function transform(QuizQuestion $result){

      return
        [ 
          "id"=>(int) $result->id,
          "quiz_session_id"=>$result->quiz_session_id,
          "question_id"=> $result->question_id,
          "status"=>$result->status,
          "created_at"=> $result->created_at,
          "updated_at"=> $result->updated_at,
          "pack_id"=>$result->pack_id,
          "category_id"=>$result->category_id,
      
          "user_one_start"=>$result->user_one_start,
          "user_two_start"=>$result->user_two_start,
    
          "question_text"=>$result->question_text,
          "category_name"=> $result->name,
          "number_of_questions"=> $result->questions,
          "real_answer"=>$this->getAnswer($result->question_id),
          "users_answers"=>$this->getUsersAnswers($this->session_id,$result->question_id)
        
         
       ];

    }
  }