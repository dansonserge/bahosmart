<script>

import {mapState} from 'Vuex';

import {feedsRoute,getHeader, userRoute} from '../config.js';

import {clientId, clientSecret } from '../.env.js';



  
  export default{
     computed:{
  ...mapState({
        userStore: state => state.userStore
       })
   },

   data:function(){
  		return {
  			posts:''
  		}
  	},
  	mounted(){
       this.$http.get(feedsRoute+this.userStore.authUser.userobject.id).then((response) => {
       this.posts=response.data.data
  		 console.log(response.data.data)
      }, (response) => {
        console.log('Things went wrong')
      });
    },
    methods:{
        singlePost:function(id){

           this.$router.push({name:'single_post/'+id})

        }
    }
  }
</script>
<template>
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
  <div class="w3-col s3"><a class="w3-btn-floating w3-red w3-white w3-border w3-border-red w3-medium likey likes like" ><i class="fa fa-heart" aria-hidden="true"></i></a></div>
                             
              <div class="w3-col s3">
                <a @click="singlePost(post.id)" class="w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium">
                   <i class="fa fa-comments" aria-hidden="true"></i>
						    </a>
              </div>

                              <div class="w3-col s3">
                                  <a href="" class="w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium"><i class="fa fa-share" aria-hidden="true"></i></a></div>
                              </div>
                             <div class="post_info">
                               <span></span>
                             </div>
                             <p class="news-date">Created at</p>
           
              </footer>    
            </div>
     </div>

  </div>
</template>

<style>
</style>