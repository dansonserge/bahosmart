<script>

import {mapState} from 'Vuex'
 

   import io from 'socket.io-client';

   const socket=io('http://192.168.10.10:8890');

  
export default{
    computed:{

...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.userStore
       }),
      
   },

   data(){

    return {

    	result:[],
    	user_one_results:'',
    	user_two_results:'',
    	user_one_data:{name:'',points:''},
    	user_two_data:[]

      
      
    }

   },
   mounted(){

   	setTimeout(this.getResult(),2000);
     
     this.user_one_results=this.userStore.results[0].answers_from_server
     this.user_two_results=this.userStore.results[1].answers_from_server
     

   },

   methods:{
    
 }
}

</script>

<template>
	<div>
		<div class="col-xs-12">
    <div v-show="userStore.current_challenge_call.user_one_id!=userStore.authUser.userobject.id" class="fail">
      You failed, please try again!
    </div>
    <div v-show="userStore.current_challenge_call.user_one_id===userStore.authUser.userobject.id" class="won">
      Congratulations, You won!
    </div>
			
		</div>
	</div>
</template>
<style>
  .fail{
    background-color: #f0743b;

    height: 50px;
    text-align: center;
    padding: auto;
    border-radius: 15px;
    padding-top: 18px;
    margin-top: 25px;
    font-stretch: bold;
    color:#fff;
    font-weight: bold;
  }
  .won{
    background-color: #30e892;

    height: 50px;
    text-align: center;
    
    border-radius: 15px;
    color:#fff;

    padding-top: 18px;
    margin-top: 25px;
    font-weight: bold;

  }


</style>