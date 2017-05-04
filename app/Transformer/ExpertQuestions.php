<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;


use App\Question;



class ExpertQuestions extends TransformerAbstract{

protected $defaultIncludes=['answers'];



public function includeanswers(Question $question){
   $answers=$question->answers;

   return $this->collection($answers,new AnswersTransformer);

}




public function transform(Question $question){

      return
        [ 

          "id" => (int) $question->id,
          "question_text"=>$question->question_text,
          "question_status"=>$question->status
         ];

}



}