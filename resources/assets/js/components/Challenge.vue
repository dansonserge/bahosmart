<script>

import {mapState,mapGetters} from 'Vuex';

import {loginRoute, getHeader, userRoute} from '../config.js';

 import {clientId, clientSecret } from '../.env.js';

  export default{
     computed:{
      

   ...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.userStore
       }),
      /*cat(id){


        const cats= this.$store.initDataStore.categories.find(categories =>categories.id === id)
    
           return cats
      
      }*/
  
   },

   data:function(){
  		return {
  			
  		}
  	},
  	mounted(){
      
    },
    methods:{
      getChallengeView:function(challenge){

         this.$store.dispatch('setCurrentChallengeView',challenge)

         this.$router.push({name:'challenge'})

         console.log('challenge page')
      }
      
    }
  }


</script>

<template>
  <div>
    <div class="list-group col-md-xs">
     <a class="list-group-item" v-for="challenge in userStore.challenges" @click="getChallengeView(challenge)">
         
         <span v-if="challenge.user_one_id != userStore.authUser.userobject.id">
         
           <img :src="challenge.user_one_picture" class="img-circle" height="50">
           <span class="card-challenge-details col-xs-10">
             
               <span class="col-xs-8 chall">
                 

                   <span class="user_chall_names">{{challenge.user_one_first_name}} {{challenge.user_one_last_name}}</span> <br>

                       <span class="cat">{{challenge.category_name}}</span> <br>

                  <span class="cat">{{challenge.pack_name}} | {{challenge.number_of_questions}} questions</span> 
               </span>

               <span class="col-xs-2 chall_received_sign">
              <i class="fa fa-angle-double-down"></i>
               </span>  

               <span class="col-xs-2">
                <!-- second sign -->
                  
               </span>

         </span>
           
          
            <i class="fa fa-caret-right pull-right card-menu-list" aria-hidden="true"></i>
        </span> 

      <span v-if="challenge.user_one_id===userStore.authUser.userobject.id">

            <img :src="challenge.user_two_picture" class="img-circle" height="50">
            <span class="card-challenge-details col-xs-10">
             
               <span class="col-xs-8 chall">
                 

                   <span class="user_chall_names">{{challenge.user_two_first_name}} {{challenge.user_two_last_name}}</span> <br>

                   <span class="cat">{{challenge.category_name}}</span> <br>

                  <span class="cat">{{challenge.pack_name}} | {{challenge.number_of_questions}} questions</span> 
                 
               </span>
               <span class="col-xs-2 chall_sent_sign">
                  <i class="fa fa-angle-double-up"></i>
               </span>  

               <span class="col-xs-2">
                <!-- second sign -->
               </span>





            </span>
           
            <i class="fa fa-caret-right pull-right card-menu-list" aria-hidden="true"></i>

      </span>



     </a>
  
  </div>
</div>


</template>

<style>
.apitest{
	font-size: 2pt;
}
</style>

