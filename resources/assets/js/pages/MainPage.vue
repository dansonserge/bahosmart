<script>
import {mapState} from 'Vuex';



import {likePostRoute,feedsRoute,getHeader,userRoute,postsRoute,getFollowers} from '../config.js';

 import {clientId, clientSecret } from '../.env.js';





export default{
    computed:{
       ...mapState({
        userStore: state => state.userStore,
        quizStore: state => state.quizStore
       })
   },
   data:function(){
  		return {
  			posts:null
  		}
  	},
  	mounted(){

  		this.getFeeds()
      this.getFollowersFx()
      this.getChallenges()


    },
    methods:{
    singlePost:function(post_id){

		 this.$store.dispatch('setSinglePost',post_id)

		 this.$router.push({name:'single_post'})
           
   },
        getFeeds:function(){
           
           this.$http.get(feedsRoute+this.userStore.authUser.userobject.id).then((response) => {
		       this.posts=response.data.data
		  		 console.log('posts',this.posts)

		      }, (response) => {
		        console.log('Things went wrong')
		      });
          },
          getChallenges:function(){


          },
          getFollowersFx:function(){
            //CHECK USER FOLLOWERS 
      this.$http.get(getFollowers+this.userStore.authUser.userobject.id).then((response) => {

      
     
      this.$store.dispatch('setUserFollowers',response.body.data)

      }, (response) => {
        console.log('Things went wrong')
      });
    
          },
          likePost:function(post){

        	let pData={
         "post_id":post.id,
         "user_id":this.userStore.authUser.userobject.id
       }

       return Vue.http.post(likePostRoute,pData).then((response)=>{
                 post.did_i_like=response.body.like
                 post.did_i_dislike=!response.body.like
                 console.log('like',response.body.like)
    
    },(response)=>{
      
     console.log("bad thing is happening")

		})
        
        },

        socketTestPage:function(){
          this.$router.push({name:'socket_test'})
        }
    }

}
</script>

<template>

<div class="contained">
<div class="navig">
 <nav class="navbar-default navbar-fixed-top nav-chat" role="navigation">
	<div id="navbar2">
	    <ul class="nav navbar-nav col-xs-12" id="navi_tab">
	       <li class="col-xs-3">
	         <a href="#chats" data-toggle="tab" >CHATS</a>
	       </li>
	       <li class="active col-xs-3">
	          <a href="#challenge" data-toggle="tab">CHALLENGE</a>
	       </li>
	         <li class="col-xs-3">
	          <a  href="#posts" data-toggle="tab">POST</a>
	       </li>
	       <li class="col-xs-3">
	          <a  href="#contacts" data-toggle="tab">CONTACTS</a>
	       </li>
	    </ul>
	</div>
 </nav>
</div>

<div class="cntnt">

  <div class="tab-content chat-tab">
      <div class="tab-pane fade" id="chats">
          <!--Chats-->
	  	  <chat></chat>
     </div>
     <div class="tab-pane fade in active" id="challenge">
         <challenge></challenge>
    </div>
      <div class="tab-pane fade" id="posts">
     <!-- POSTS ////////////////////////////////////////////-->
 <div class="container">
    <div class="col-xs-12">
      <router-link :to="{name:'new_post'}">
	      <a class="btn btn-primary"><i class="fa fa-plus"></i></a>
	    </router-link>
    </div>
  	

  	  <div class="col-md-3 col-sm-4 article-cell my-card" v-for="post in posts">
          <div class=" w3-card-2">
            <p class="w3-center post_title col-xs-10">
               {{post.title}} 
             </p> 
            
      
           <post-editor></post-editor>
     
                   <div class="post_image">
                  
                       <img :src='post.image'>
               
                   </div>
                  

            <p class="post_text">

          {{post.post_text}}
                      </p>
              <hr>
             <footer class="w3-container">
                   
                             <div class="w3-row">

                              <div class="w3-col s3">
                               <a @click="likePost(post)" :class="{'w3-btn-floating':true, 
                                'w3-red w3-white w3-border w3-border-red w3-medium likey likes like':post.did_i_like,
                                'w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium':post.did_i_dislike
                               }">
                               <i class="fa fa-heart" aria-hidden="true"></i>
                              </a></div>
                             
                              <div class="w3-col s3">
                           
                <a @click="singlePost(post.id)" class="w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium">
                   <i class="fa fa-comments" aria-hidden="true"></i>
						    </a>
          </div>

                              <div class="w3-col s3"><a href="" class="w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium"><i class="fa fa-share" aria-hidden="true"></i></a></div>
                              

                         
                             </div>
                             <div class="post_info">
                               <span></span>
                             </div>
                             <p class="news-date">Created at</p>
           
              </footer>    
            </div>
     </div>

  </div>
<!-- ///////////////////////////// POSTS  -->


     </div>
     <div class="tab-pane fade" id="contacts">
      <!--Contats-->
  	      <contact></contact>
       </div> 
    </div>
  </div>
</div>

</template>

<style>


</style>