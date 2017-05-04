<script>
    
import {mapState} from 'Vuex';

import {clientId, clientSecret } from '../.env.js';
  
import {startChallenge,cancelRequestCall} from '../config.js';


import io from 'socket.io-client';

const socket=io('http://192.168.10.10:8890');

export default{

    computed:{
       ...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.initDataStore
       })
   },
   mounted(){

    if(this.userStore.current_challenge_call==null){

     // || this.userStore.authUser.userobject.id==null

       this.$router.push({name:'main'})
   
    }else{

      this.challenge=this.userStore.current_challenge_call
        
        }
      },
   data:function(){

    return{
      challenge:''
     }
   },
  methods:{
    cancelRequestC:function(challenge){
     
       const pData={ 
                    
                  }

       this.$http.post(cancelRequestCall,pData).then((response) => {
 
           console.log(response)
        

         
            }, (response) => {
        
              console.log("something went wrong")
             

            });
     },
     startChallengeC:function(challenge){

       const pData={ 
                    'category_id':challenge.category_id,

                    'category_name':challenge.category_name,

                    'channel_type':challenge.channel_type,

                    'number_of_questions':challenge.number_of_questions,

                    'pack_id': challenge.pack_id,

                    'pack_name': challenge.pack_name,

                    'quiz_session_id': challenge.quiz_session_id,

                    'status':challenge.status,

                    'user_one_first_name': challenge.user_one_first_name,

                    'user_one_id':this.userStore.authUser.userobject.id,

                    'user_one_last_name':challenge.user_one_last_name,

                    'user_one_picture': challenge.user_one_picture,

                    'user_two_first_name': challenge.user_two_first_name,

                    'user_two_id': challenge.user_two_id,

                    'user_two_last_name':challenge.user_two_last_name,

                    'user_two_picture':challenge.user_two_picture

                  }

       this.$http.post(startChallenge,pData).then((response) => {
 
           console.log(response)
        

         
            }, (response) => {
        
              console.log("something went wrong")
             

            });

     }
    
  }
}
</script>
<template>
  <div >
     <div class="call-view">
       


      <div class="col-xs-12">
           <div class="col-xs-12">
             <!-- receiver -->
       <span v-if="challenge.user_one_id != userStore.authUser.userobject.id">
       
               
         <div class="col-xs-12 incall-view">
           
            <img :src="challenge.user_one_picture" class="img-circle" height="200">
         </div>
         <div class="col-xs-12 incall-view">

             <span><strong>{{challenge.user_one_first_name}} {{challenge.user_one_last_name}}</strong></span>
           
         </div>
      </span> 


          <!-- sender -->
      <span v-if="challenge.user_one_id === userStore.authUser.userobject.id">
         
         <div class="col-xs-12 incall-view">
          
             
            <img :src="challenge.user_two_picture" class="img-circle" height="200">
           </div>
         <div class="col-xs-12 incall-view">
         
             <span><strong>{{challenge.user_two_first_name}} {{challenge.user_two_last_name}}</strong></span>
            
        </div>
              
           
      </span>

           </div> 
      </div>
        <div class="col-xs-12 incall-view-pack">
                 <div class="col-xs-12 ">
                   
                   <div class="col-xs-12 incall-view">
                 
                   <span>{{challenge.category_name}}</span>
                 </div>    
               <div class="col-xs-12 incall-view">
                 <span>{{challenge.pack_name}} ({{challenge.number_of_questions}} questions)</span>
               </div>  
           </div>
       </div>
     <div class="col-xs-12">


             <!-- receiver -->

     <span v-if="challenge.user_one_id != userStore.authUser.userobject.id">
           <div class="col-xs-12 incall-view">
                
                  <a class="w3-btn-floating w3-red w3-white w3-border w3-border-red w3-large" @click="cancelRequestC(challenge)">

                   <i class="fa fa-times" aria-hidden="true"></i>

                  </a>
             </div>
       </span>


          <!-- sender  -->
  <span v-if="challenge.user_one_id === userStore.authUser.userobject.id">

          <div class="col-xs-12 incall-view">
                <div class="card-content col-xs-6">
                  <a class="w3-btn-floating w3-red w3-white w3-border w3-border-red w3-large" @click="cancelRequestC(challenge)">
                    
                   <i class="fa fa-times" aria-hidden="true"></i>

                  </a>
                </div>
                <div class="card-content col-xs-6">
                  <a class="w3-btn-floating w3-green w3-white w3-border w3-border-green w3-large" @click="startChallengeC(challenge)">
                   <i class="fa fa-check" aria-hidden="true"></i>
                    
                  </a>
                </div>
          </div>
        </span>
      </div>
   </div>
 </div>
</template>
<style>

.call-view{
  text-align: center;
  height: 100%;
  padding-top: 8%;
}
.incall-view{
  margin-top: 10px;
}
</style>