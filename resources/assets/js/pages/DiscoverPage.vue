<script>
import {mapState} from 'Vuex'

import { getHeader,followUsersRoute,followUserRoute} from '../config.js';

import {clientId, clientSecret } from '../.env.js';

export default{
   computed:{

            ...mapState({
        userStore: state => state.userStore
           })


       },
       data:function(){
       	return {
       		usersToFollowObj:null
       	}
       },
	mounted:function(){

      this.usersToFollow()

   },


   methods:{
      usersToFollow:function(){
        let postData={
		        	'grant_type':'password',
                    'client_id':clientId,
                    'client_secret':clientSecret,
                    'userid':this.userStore.authUser.userobject.id,
                    }

this.$http.post(followUsersRoute, postData).then((response)=>{ 		
 
         this.usersToFollowObj=response.body.data

         console.log(this.usersToFollowObj)
        
	 }, (response) => {

    console.log(response)
 
      })
      },
      addUser:function(user){

      	

         let postData={
		        	'grant_type':'password',
                    'client_id':clientId,
                    'client_secret':clientSecret,
                    'user_id':this.userStore.authUser.userobject.id,
                    'follows_user_id':user.id
                    }

                    console.log('we are hitting the function!');

       this.$http.post(followUserRoute, postData).then((response)=>{ 		
            console.log(response) 

            user.followed=response.body.follow     

            user.followers=user.followers + response.body.operation
	 }, (response) => {

    console.log("something went wrong")
 
      })             

      }

   }
}
</script>
<template>
<div class="content_wrapper row">
  <div class="col-xs-12">
    
  <div class="row continue">
     <router-link :to="{name:'feeds'}">       
  <a v-show="followed_categories != 0" class="btn btn-primary find_ppl_to_follow" >
     Continue
    <i class="fa fa-arrow-right" aria-hidden="true"></i>
  </a>
  </router-link>
 
          <div class="col-xs-4"></div>
      </div>

      <div class="row">
          

          <discovering>
          </discovering>

      </div>
 
  	
   <div class="row">
     
  
     <div class="col-md-2 col-sm-3 article-cell my-card" v-for="user in usersToFollowObj">
        <div class=" w3-card-2">
        <div class="row">
          <p class="w3-center post_title">
              {{user.first_name}}
          </p>

        	
        </div>
          <div class="post_image">
            <img class="img-responsive" :src="user.profile_picture">      
          </div>
          <p><!--status-->
          </p> 
          <hr>
             <footer class="w3-container">
             <table class="table table-responsive">
             	
             	<tr class="before-follow-info">
             		<td>
             	     <table>
                      	<tr>
                      		<td>Post</td>
                      	</tr>
                      	<tr>
                      	  
                      	  <td>{{user.followers}}</td>
                      	  
                      	</tr>
                      </table>
             		</td>
             		<td>
             			Followers 
             			<br>
             			  {{user.followers}}
             		</td>
             		<td>
             		    Following
             		    <br>
             		      {{user.following}}
             		</td>
             	</tr>
             	<tr>
             		<td>
             			<td colspan="3"> 
                  <a :class="{'btn btn-primary':true,'addfollowEffect':user.followed}" 
                  @click="addUser(user)">


                  <span v-if="user.followed">FOLLOWING</span>


                  <span v-else="!user.followed">FOLLOW</span>

                  <i :class="{'fa fa-check-circle':user.followed}" 
                  aria-hidden="true"></i></a>
             			</td>
             		</td>
             	</tr>
             </table>
            </footer>
           </div>

            </div>
      </div>

  </div>

   </div>

</template>

<style>
</style>