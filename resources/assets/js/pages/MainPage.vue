<script>
import {mapState} from 'Vuex';



import {likePostRoute,feedsRoute,getHeader,userRoute,postsRoute,getFollowers,submitPost} from '../config.js';

 import {clientId, clientSecret } from '../.env.js';





export default{
    computed:{
       ...mapState({
        userStore: state => state.userStore,
        quizStore: state => state.quizStore,
        initDataStore: state => state.initDataStore,

       })
   },
   data:function(){
  		return {
  			posts:null,
        new_post_img:'',

        new_post:{
        title:'',
        image:'',
        post_text:'',
        category_id:'',
        user_id:''
       },

       new_question:{
        category_id:'',
        question_text:'',
        expert_id:''
        },

        answers:{
          answer_1:{
            answer_text:'',
            is_correct:'',
          },
          answer_2:{
            answer_text:'',
            is_correct:'',
          },
          answer_3:{
            answer_text:'',
            is_correct:'',
          },
          answer_4:{
            answer_text:'',
            is_correct:'',
          },
          

        }
  	}
  },
  	mounted(){

  		this.getFeeds()
      this.getFollowersFx()
      this.getChallenges()

    
      $(".new_post_img").hide();

      $("input[type='file']").hide();

      $('.upload-pic').click(function(){

      $("input[type='file']").trigger('click');
     
      });


/*
      $('input[type="file"]').on('change', function() {
  var val = $(this).val();
  $(this).siblings('span').text(val);
})

*/

    },
    methods:{

      handleLogout:function(){
        window.localStorage.removeItem('authUser')
        this.$store.dispatch('clearAuthUser')

       

        window.localStorage.removeItem('userCategories')
        
        window.localStorage.removeItem('categoryLength')

       
       
        window.localStorage.removeItem('setUserInfo')
     

        

        this.$store.dispatch('clearUserCategories')

        this.$store.dispatch('clearCategoryLength')

        this.$store.dispatch('clearUserFollowers')


        this.$store.dispatch('clearUsersToFollow')
         
        this.$router.push({name: 'home'})
      },
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
        },



onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                  $(".new_post_img").show();
                this.createImage(files[0]);


            },
            createImage(file) {
                
             

                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.new_post.image = e.target.result;


                };
                reader.readAsDataURL(file);
            },

            submitPost(){

                      const postData={
                       
                       'title':this.new_post.title,
                       'post_text':this.new_post.post_text,
                       'image':this.new_post.image,
                       'category_id':this.new_post.category_id,
                       'user_id':this.userStore.authUser.userobject.id,
                       'scope':''

                      }
      
      this.$http.post(submitPost,postData).then((response) => {


                           console.log(response)

                           //show login vue

                        
                             
                                }, (response) => {

                           console.log(response)

                          
 
                        });
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
            <a @click="handleLogout()">Logout</a>
	  	  <chat></chat>
     </div>
     <div class="tab-pane fade in active" id="challenge">
         <challenge></challenge>
    </div>
      <div class="tab-pane fade" id="posts">
     <!-- POSTS ////////////////////////////////////////////-->
 <div class="container">
    
 <div class="col-md-3 col-sm-6 my-card">
     <form v-on:submit.prevent="submitPost" enctype="multipart/form-data">
            <div class="notification">
              
         <!-- add an error here -->
            </div>
          
            
        

              <div class="w3-card-2 new-post"> 
                    
                    <input type="text" name="title" class="form-control" placeholder="Add title" v-model="new_post.title">

                    <div style="width='100%'" class="uploading-area">
                    <div class="new_post_img">
                    <img :src="new_post.image" class="img-responsive">
                      
                    </div>

                    <a class="w3-btn-floating-large w3-teal w3-medium upload-pic">
                   <i class="fa fa-picture-o fa-lg" aria-hidden="true"></i></a>
                  

                  <input type="file" name="image" class="upload" placeholder="Choose image" v-on:change="onFileChange">
                    
                     <span class="image_name"></span>
                   </div>
                    
                  
                  <textarea class="form-control" name="post_text" placeholder="What's new!" rows="4" v-model="new_post.post_text"></textarea>
                   <footer>
                   <table>
                       <tr>
                         <th>
                           
                   <select placeholder="Category" class="form-control" v-model="new_post.category_id" name="category_id">
                      <option disabled>Member Type</option>
                      <option :value="category.id" v-for="category in initDataStore.categories">{{category.name}}</option>
                   </select>
                         </th>
                         <th>
                           <button class=" newsctrl w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium submit-post " type="submit">
             <i class="fa fa-upload" aria-hidden="true"></i>
           </button>
                         </th>

                       </tr>
                     </table>
                     <div>
                     </div>

                    </footer>   
                  
                   
              </div>
                </form>     
            </div>



            <!-- posts -->

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
.new_post_img img{
        max-height: 250px;
       
    }
    .new_post_img{

    }


</style>