<script>
import {mapState} from 'Vuex'

import { getHeader,followUsersRoute} from '../config.js';

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
      }

   }
}
</script>

<template>

<div class="col-xs-12">
  
<div class="row">
          

          <discovering>
          </discovering>

      </div>
 

  <div class="content_wrapper">
     <div class="col-md-3 col-sm-6 article-cell my-card" v-for="user in usersToFollowObj">
        <div class=" w3-card-2">
          <p class="w3-center post_title col-xs-10">
              {{user.first_name}}
          </p>
          <div class="post_image">
             <!--Image-->       
          </div>
          <p>
          	<!--status-->
          </p> 
          <hr>
          <footer class="w3-container">
             <div class="col-md-12 before-follow-info">
	                 <div class="col-xs-4">
	                    posts<br>{{user.followed}}
                     </div>
	                 <div class="col-xs-4">
	                    followers<br> {{user.followers}}
	                 </div>
	                 <div class="col-xs-4">
	                    following <br>{{user.following}}
	                 </div>
              </div>
               <div class="col-md-12 follow">
                  <div class="col-xs-3 col-xs-offset-4 centered" >
                      <a class="btn btn-primary follow-btn ">
                        FOLLOW <!--check if is following or not-->
                      </a>
                  </div>
               </div>
            </footer>

        </div>
      </div>
  </div>


  </div>

</template>

<style>
</style>