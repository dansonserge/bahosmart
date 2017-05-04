<script>
import {mapState} from 'Vuex'

import { getHeader,followUsersRoute,followUserRoute} from '../config.js';

import {clientId, clientSecret } from '../.env.js';

export default{
   computed:{

            ...mapState({
        userStore: state => state.userStore
           }),
        },
       data:function(){
         return {
             gameyard:false,
             pre_game_counter:true,
             
             first_timer_seconds:6,
             question_countdown:15,

             question_text:null,
             answer_one_text:null,
             answer_two_text:null,
             answer_three_text:null,
             answer_four_text:null,

             question_id:null,
             answer_one_id:null,
             answer_two_id:null,
             answer_three_id:null,
             answer_four_id:null,

             user_one_names:null,
             user_two_names:null,

             user_one_id:null,
             user_two_id:null,

             user_one_pic:null,
             user_two_pic:null,
   
             questionIndex:0,
             quiz_session_id:0,
             
             number_of_questions:'',
             total_number_of_questions:'',
             selected_answer_number:0,
             selected_answer_id:0,
             question_id:0
             
         }
      },

       mounted(){
        this.number_of_questions=this.userStore.challenge.number_of_questions
        this.total_number_of_questions=this.userStore.challenge.number_of_questions
        this.quiz_session_id=this.userStore.challenge.quiz_session_id

         this.firstTimer()

         this.selected_answer_id=0
         this.selected_answer_number=0
         this.question_id=0

         

       },
       methods:{

        firstTimer:function(){
           this.first_timer_seconds--;
          
           
          if(this.first_timer_seconds!=0){
          setTimeout(this.firstTimer,1000);
          }else{
           console.log('first count down finished!')
           this.showGameyard()
           this.questionCountDown()
          }
        },
      showGameyard:function(){
        this.gameyard=true
        this.pre_game_counter=false
        this.getQuestion()
      },
      getQuestion:function(){
           this.question_text=this.userStore.challenge.questions[this.questionIndex].question_text
           this.answer_one_text=this.userStore.challenge.questions[this.questionIndex].answers[0].answer_text
           this.answer_two_text=this.userStore.challenge.questions[this.questionIndex].answers[1].answer_text
           this.answer_three_text=this.userStore.challenge.questions[this.questionIndex].answers[2].answer_text
           this.answer_four_text=this.userStore.challenge.questions[this.questionIndex].answers[3].answer_text

           this.question_id=this.userStore.challenge.questions[this.questionIndex].id
           this.answer_one_id=this.userStore.challenge.questions[this.questionIndex].answers[0].id
           this.answer_two_id=this.userStore.challenge.questions[this.questionIndex].answers[1].id
           this.answer_three_id=this.userStore.challenge.questions[this.questionIndex].answers[2].id
           this.answer_four_id=this.userStore.challenge.questions[this.questionIndex].answers[3].id


       },
     questionCountDown:function(){
      
      this.question_countdown--;
     if(this.question_countdown<10){
      this.question_countdown='0'+this.question_countdown;
     }
    if(this.question_countdown != 0){
    
     setTimeout(this.questionCountDown,1000)
    
    }
    else{
       
       this.newQuestion()
        
       }
     },

     newQuestion:function(){
       

       this.number_of_questions--;
       
       this.questionIndex++;

        this.selected_answer_number=0;
        this.selected_answer_id=0; 

       setTimeout(this.answering,50)


      
      if(this.number_of_questions==0){
        console.log('questions finished!')
      
        this.$router.push({name:'main'})

      }
      else{
       this.getQuestion()

       this.question_countdown=15

       this.questionCountDown();

      }
    
   },
  getAnswer:function(payload){

        console.log(payload.answer.answer_id);

        this.selected_answer_number=payload.answer.number;
        this.selected_answer_id=payload.answer.id;

      },
      resetAnswer:function(){
        
        this.selected_answer_number=0;
        this.selected_answer_id=0;
      },
      answering:function(){

          var data={
        "user_id":this.userStore.authUser.userobject.id,
        "quiz_session_id":this.quiz_session_id,
        "question_id":this.question_id,
        "answer_id":this.answer_id
      }

        this.$store.dispatch('addSelectedAnswers',data)
       
      }
   }
}
</script>
<template>
	<div>

<div class="gameyard">

  <!-- MAIN VIEW -->
    <div class="col-xs-12 challenge-opponents">
        <span class="chall-img-div" v-if="userStore.challenge.user_one_id === userStore.authUser.userobject.id">

                <div class="pull-left">
                  <div class="col-xs-12">
                      <img :src="userStore.challenge.user_two_picture" class="img-circle" height="20">
                  </div>
                   <div class="col-xs-12">
                     <span>{{userStore.challenge.user_two_first_name}}</span>
                  </div> 
                </div>
              
                <div class="pull-right">
                  <div class="col-xs-12">
                      <img :src="userStore.challenge.user_one_picture" class="img-circle" height="20">
                  </div>
                   <div class="col-xs-12">
                     <span>{{userStore.challenge.user_one_first_name}}</span>
                  </div> 
                </div>
            
           
      </span>

       <span class="chall-img-div" v-if="userStore.challenge.user_two_id === userStore.authUser.userobject.id">

                <div class="pull-left">
                  <div class="col-xs-12">
                      <img :src="userStore.challenge.user_one_picture" class="img-circle" height="40">
                  </div>
                   <div class="col-xs-12">
                     <span>{{userStore.challenge.user_one_first_name}}</span>
                  </div> 
                </div>
              
                <div class="pull-right">
                  <div class="col-xs-12">
                      <img :src="userStore.challenge.user_two_picture" class="img-circle" height="40">
                  </div>
                   <div class="col-xs-12">
                     <span>{{userStore.challenge.user_two_first_name}}</span>
                  </div> 
                </div>
            
           
      </span>

     </div>
<div id="playground" class="col-xs-12" v-show="gameyard">
     <div class="col-xs-12 challenge-time-info">
     <div class="row">
       <span class="number-questions"> {{number_of_questions}}/{{total_number_of_questions}} </span>
       
     </div>

     <div class="row">
       <span class="question-countdown">00 : {{question_countdown}}</span> 
       
     </div>
     </div>

     

     <div class="col-xs-12 challenge-question">
       <p>{{question_text}}</p>
     </div>  

<div class="col-xs-12 reset-btn" v-show="selected_answer_id != 0">
    <div class="col-xs-9">
      <div class="selected-answer">
          <p>
            {{selected_answer_number}}
          </p>
      </div>
    </div>
    
    <div class="col-xs-3"><a class="btn btn-primary" v-on:click="resetAnswer()">Reset</a></div>
</div>

<div class="col-xs-12 challenge-answers">
    <div class="col-xs-12 challenge-answer" v-on:click="getAnswer({'answer':{'number':1,'answer_id':answer_one_id}})">
         <div class="col-xs-1">
        </div>
         <div class="col-xs-11 challenge-answer-text">
          <div class="challange-answer-number">
              <p>1</p>
           </div>
           <p>{{answer_one_text}}</p>
         </div>
      </div>

       <div class="col-xs-12 challenge-answer" v-on:click="getAnswer({'answer':{'number':2,'answer_id':answer_two_id}})">
         <div class="col-xs-1">
           
         </div>
        <div class="col-xs-11 challenge-answer-text">
         <div class="challange-answer-number">
              <p>2</p>
           </div>
           <p>{{answer_two_text}}</p>
         </div>
      </div>

       <div class="col-xs-12 challenge-answer" v-on:click="getAnswer({'answer':{'number':3,'answer_id':answer_three_id}})">
         <div class="col-xs-1">
          
         </div>
         <div class="col-xs-11 challenge-answer-text">
          <div class="challange-answer-number">
              <p>3</p>
           </div>
           <p>{{answer_three_text}}</p>
         </div>
      </div>

       <div class="col-xs-12 challenge-answer" v-on:click="getAnswer({'answer':{'number':4,'answer_id':answer_four_id}})">
         <div class="col-xs-1">
           
         </div>
         <div class="col-xs-11 challenge-answer-text">
         <div class="challange-answer-number">
              <p>4</p>
           </div>
           <p>{{answer_four_text}}</p>
         </div>
      </div>
</div>
   </div>
 </div>

 <!-- FIRST COUNTER VIEW -->
    <div class="pre-game-counter" v-show="pre_game_counter">
          
          <p class="start_time">00 : 0{{first_timer_seconds}}</p>

    </div>
	</div>
</template>
<style>

.gameyard p{
  margin-left:2px;
  margin-right:2px;
}

	.pre-game-counter{
      position: absolute;
      background-color: #fff;
      width: 100%;
      height: 100%;
      padding-top:50%;
    }

  .start_time{
    text-align: center;
  }

  .gameyard{
        
    }
.challenge-time-info{
  text-align: center;
   padding-left:5px; 
  padding-right: 5px;
}

.challenge-opponents{
  text-align: center;
   padding-left:0px; 
  padding-right: 0px;
 
border-bottom: #ccc 1px solid;
background-color: #f1f1f1;

margin-bottom: 3px;

padding-top: 3px;
padding-bottom: 3px;

font-weight: bold;

}

.challenge-question{
  text-align: center;
  background-color:#d9edf7;
 height:100%;

 font-weight: bold;

  padding-top: 10px; 
   padding-bottom: 10px; 

     box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  margin-top: 10px;
  margin-bottom: 10px;
}
 .challenge-question p{
  margin:auto;
 }

.gameyard .col-xs-12{
  padding-left:5px; 
  padding-right: 5px;
}

.number-questions{
  
  background-color: #f0f0f0;
  border-radius: 10px;
padding-left:8px;
padding-right:8px;

box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  margin-top: 10px;
}
.question-countdown{

background-color: #f0f0f0;
border-radius: 10px ;
padding-left:8px;
padding-right:8px;
box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  margin-top: 10px;

}
#playground{


}

.challenge-answers{
  
}

.challange-answer-number{

position: absolute;

background-color: #f2dede;

font-weight: bold;
text-align: center;



height: 20px;
width: 20px;

margin-left:-45px;

border-radius: 5px;


   box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.challange-answer-number:before{
  position: absolute;
  height: 10px;
  width: 10px;
  background-color: #f2dede;
  content:'';
  transform: rotate(45deg);
  top: 5px;
  margin-left:4px;

 
   
}

.challange-answer-number p{
  position: relative;

margin:auto;
}

.challenge-answer-text{
  background-color: #dff0d8;
  margin-top: 10px;
 
  margin-right:3px;
  float:right;

   padding-top: 10px; 
   padding-bottom: 10px; 

   cursor: pointer;


   box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}

.challenge-answer-text:hover{
 box-shadow: 0 7px 14px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

.challenge-answer-text p{
  margin: 0px auto;
}

.reset-btn{
  margin-top: 3px;
}
.selected-answer{
background-color: red;

font-weight: bold;

height: 30px;
width: 30px;

text-align: center;
padding-top: 3px;
margin-left:50%;
border-radius: 30px;

color:#fff;

  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}






</style>