<?php

namespace App\Transformer;

use League\Fractal\TransformerAbstract;

use App\Answer;



class AnswersTransformer extends TransformerAbstract{
  
  public function transform(Answer $answer){
      return
        [ 
          "id"=>(int) $answer->id,
          "answer_text"=>$answer->answer_text,
          "is_correct"=>$answer->is_correct
        ];
      }
   }