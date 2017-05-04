<script>
  
  import {mapState} from 'Vuex';

  import {clientId, clientSecret } from '../.env.js';
  
import {challengeRequest} from '../config.js';
	export default{

		computed:{
       ...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.initDataStore
       })
   },
   mounted(){

   	if(this.userStore.current_user==null){

   		 this.$router.push({name:'main'})
   	}else{
   		this.user=this.userStore.current_user
   	
   	}
   
 
    
   },
   data:function(){

   	return{
   		user:'',
      challenge:{
        pack_id:'',
        category_id:'',
        user_one_id:'',
        user_two_id:''
      }
   
    }
  },
  methods:{
    sendRequest:function(event){
        const pData=

        {

             'grant_type':'password',
             'client_id':clientId,
             'client_secret':clientSecret,
             'pack_id':this.challenge.pack_id,
             'category_id':this.challenge.category_id,

             'user_one_id':this.userStore.authUser.userobject.id,
             'user_one_first_name':this.userStore.authUser.userobject.first_name,
             'user_one_last_name':this.userStore.authUser.userobject.last_name,
             'user_one_picture':this.userStore.authUser.userobject.profile_picture,
             
             'user_two_id':this.userStore.current_user.id,
             'user_two_first_name':this.userStore.current_user.first_name,
             'user_two_last_name':this.userStore.current_user.last_name,
             'user_two_picture':this.userStore.current_user.profile_pic
         
           }
             
         this.$http.post(challengeRequest,pData).then((response) => {
             
               
           
             //console.log(response)
             
             this.$router.push({name:'main'})

          }, (response) => {
        console.log(response)
        });
    }
  }
}
</script>
<template>
  <div>
      <div class="col-xs-12">
           <div class="card card-2 col-xs-12">
               <img :src="user.profile_pic" class="img-circle" height="100">
               <span>{{user.first_name}} {{user.last_name}}</span>
           </div> 
      </div>
      <div class="col-xs-12">
           <div class="card card-2 col-xs-12">
                <div class="card-content">
                   <a class="btn btn-primary">Message</a>
                </div>
                 <hr>
                <div class="card-content">
                  

                   <div class="panel-group">
               
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse1">
                         <a class="btn btn-primary">Challenge</a>
                      </a>
                    </h4>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse">
                   <form v-on:submit.prevent="sendRequest">
                    <div class="panel-body">


                      
                     <input type="hidden" v-model="challenge.user_two_first_name" :value="user.first_name">
                     <input type="hidden" v-model="challenge.user_two_last_name" :value="user.last_name">
                     <input type="hidden" v-model="challenge.user_two_picture" :value="user.profile_pic">

                  
                   

                      <div class="form-group">
                           <label for="category" class="pull-left">Category:</label>
                           <select class="form-control" id="category" v-model="challenge.category_id">
                                   <option value="0">Category</option>
                                   <option v-for="category in initDataStore.categories" :value="category.id">{{category.name}}</option>
                           </select>
                       </div>
                        <div class="form-group" >
                           <label for="category" class="pull-left">Pack:</label>
                           <select class="form-control" id="category" v-model="challenge.pack_id">
                                   <option value="0">Pack</option>
                                   <option v-for="pack in initDataStore.packs" :value="pack.id">  {{pack.name}} | {{pack.questions}} questions</option>
                           </select>
                       </div>

                  
                    </div>
                    <div class="panel-footer request-challenge">
                          <input type="submit" value="Send the Request" class="btn btn-success request-challenge-btn" v-if="challenge.category_id!=0 && challenge.pack_id!=0">
                    </div>
                            
                 </form>
                  </div>
                </div>
                </div>
                </div>
           </div>
      </div>
 </div>
</template>
<style>
</style>