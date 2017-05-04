<script>
	import {mapState} from 'Vuex';


import {likePostRoute,singlePostRoute,getHeader,userRoute,postsRoute} from '../config.js';

 import {clientId, clientSecret } from '../.env.js';


  
  export default{
     computed:{
      

   ...mapState({
        userStore: state => state.userStore
       })
   },
   prop:['postId'],

   data:function(){
  		return {
  			posts:''
  		}
  	},
   
  	mounted(){
       this.getFeed()
     },
    methods:{
    	 getFeed:function(){
           this.$http.get(singlePostRoute+this.userStore.singlePost+'/'+this.userStore.authUser.userobject.id).then((response) => {
           this.posts=response.data.data
           console.log(response.data.data)
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
        
        }


      }

    }
</script>
<template>
	


 <div class="container">
   
  	  <div class="col-md-3 col-sm-4 article-cell my-card" v-for="post in posts">
          <div class=" w3-card-2">
            <p class="w3-center post_title col-xs-10">
               {{post.title}} 
             </p> 
            
      
           <post-editor>
           </post-editor>
      
                   <div class="post_image">
                  
                       <img :src='post.image'>
               
                   </div>
                  

            <p class="post_text">

          {{post.post_text}}
                      </p>
              <hr>
             <footer class="w3-container">
                   
                      <div class="w3-row">
                     <div class="w3-col s3"><a @click="likePost(post)" :class="{'w3-btn-floating':true, 
                              'w3-red w3-white w3-border w3-border-red w3-medium likey likes like':post.did_i_like,
                              'w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium':post.did_i_dislike}">
                              <i class="fa fa-heart" aria-hidden="true"></i></a>
                     </div>
                           
                     <div class="w3-col s3">
                      <a href="" class="w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium">
                        <i class="fa fa-share" aria-hidden="true"></i>
                      </a>
                   </div>
                </div>
            <div class="post_info">
                <span></span>
            </div>
               </footer>    
            </div>
     </div>

  </div>
</template>
<style type="text/css"></style>