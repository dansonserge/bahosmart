<script>
  
  import {mapState} from 'Vuex';

  import {clientId, clientSecret } from '../.env.js';
  
import {acceptRequest} from '../config.js';


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

   	if(this.userStore.current_challenge_view==null){

     // || this.userStore.authUser.userobject.id==null

   		 this.$router.push({name:'main'})
   
   	}else{

   		this.challenge=this.userStore.current_challenge_view
   	
   	}
   
     // this.challenge=this.userStore.current_challenge_view
 
    
   },
   data:function(){

   	return{
   		challenge:''
   
    }
  },
  methods:{
    acceptRequest:function(challenge){

      
      

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

                    'user_one_id': challenge.user_one_id,

                    'user_one_last_name':challenge.user_one_last_name,

                    'user_one_picture': challenge.user_one_picture,

                    'user_two_first_name': challenge.user_two_first_name,

                    'user_two_id': this.userStore.authUser.userobject.id,

                    'user_two_last_name':challenge.user_two_last_name,

                    'user_two_picture':challenge.user_two_picture

                  }

       this.$http.post(acceptRequest,pData).then((response) => {
 
           console.log(response)
        

            // socket.emit('challenge_start',challenge);
         
            }, (response) => {
        
              console.log("something went wrong")
             

            });
     }
    
  }
}
</script>
<template>
  <div>
      <div class="col-xs-12">
           <div class="card card-2 col-xs-12">
             <!-- receiver -->
       <span v-if="challenge.user_one_id != userStore.authUser.userobject.id">
         
            <img :src="challenge.user_one_picture" class="img-circle" height="100">
          
             <span><strong>{{challenge.user_one_first_name}} {{challenge.user_one_last_name}}</strong></span>
             

               <span class="col-xs-2 chall_view_received_sign pull-right">
                 <i class="fa fa-angle-double-down"></i>
               </span>  
        </span> 


          <!-- sender -->
      <span v-if="challenge.user_one_id === userStore.authUser.userobject.id">

            <img :src="challenge.user_two_picture" class="img-circle" height="100">
            
             <span><strong>{{challenge.user_two_first_name}} {{challenge.user_two_last_name}}</strong></span>

              <span class="col-xs-2 chall_view_sent_sign pull-right">
                  <i class="fa fa-angle-double-up"></i>
               </span>  
           
      </span>

           </div> 
      </div>




            <div class="col-xs-12">
                 <div class="card card-2 col-xs-12">
                    <!--  <table class="table table-bordered">
                        <tr>
                          <th>Category</th>
                          <td>{{challenge.category_name}}</td>
                        </tr>
                        <tr>
                          <th>Pack</th>
                          <td>{{challenge.pack_name}} | {{challenge.number_of_questions}} questions</td>
                        </tr>
                     </table> -->



                 
                     <div class="col-xs-12">
                       <div class="col-xs-6"><strong>Category</strong></div>
                       <div class="col-xs-6">{{challenge.category_name}}</div>
                     </div>
                     <hr>
                     <div class="col-xs-12">
                       <div class="col-xs-6"><strong>Pack</strong></div>
                       <div class="col-xs-6">{{challenge.pack_name}} ({{challenge.number_of_questions}} questions)</div>
                     </div>
                 </div>
            </div>






      <div class="col-xs-12">


             <!-- receiver -->

     <span v-if="challenge.user_one_id != userStore.authUser.userobject.id">
           <div class="card card-2 col-xs-12">
                <div class="card-content">
                  <button class="w3-button w3-white w3-border w3-border-green w3-round-large" @click="acceptRequest(challenge)">Accept</button>
                </div>
                 <hr>
                <div class="card-content">
                   <button class="w3-button w3-white w3-border w3-border-red w3-round-large">Reject</button>
                </div>
            </div>
    </span>


          <!-- sender  -->
  <span v-if="challenge.user_one_id === userStore.authUser.userobject.id">

           <div class="card card-2 col-xs-12">
                <div class="card-content">
                  <button class="w3-button w3-white w3-border w3-border-red w3-round-large">Cancel</button>
                </div>
              
            </div>
    </span>







      </div>
 </div>
</template>
<style>
</style>