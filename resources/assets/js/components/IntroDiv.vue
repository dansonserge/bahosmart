<script>
//import urlRoute
import {mapState} from 'Vuex';

import {signupRoute,loginRoute, getHeader, userRoute,userCatsRoute,userCategories, getFollowers} from '../config.js';

import {clientId, clientSecret } from '../.env.js';
export default {

      computed:{

         ...mapState({
        userStore: state => state.userStore
       })

      },

        mounted() {
       
        },
       
        data:function(){
          return {
                     loginShow:false,
                     
                     signupShow:true,

                     signup_error:false,
                     signin_error:false,

                     signup_error_data:'',
                     signin_error_data:'',

                     login:{
                      email:'',
                      password:''
                     },
                     signup:{
                      first_name:'',
                      last_name:'',
                      email:'',
                      password:'',
                      password_confirmation:''
                  }
            }
        },
        methods:{ 

         
          showSignup:function(event){
                  this.loginShow=false;
                  this.signupShow=true;
                    },
                    
          showLogin:function(event){
                      this.loginShow=true;
                      this.signupShow=false;
                    },
          handleSignup:function(){
                      const postData={
                       'grant_type':'password',
                       'client_id':clientId,
                       'client_secret':clientSecret,
                       'first_name':this.signup.first_name,
                       'last_name':this.signup.last_name,
                       'email':this.signup.email,
                       'password':this.signup.password,
                       'password_confirmation':this.signup.password_confirmation,
                       'scope':''

                      }

                     this.$http.post(signupRoute,postData).then((response) => {


                           console.log(response)

                           //show login vue

                           this.loginShow=true;

                           this.signupShow=false;
                             
                                }, (response) => {

                           console.log(response)

                           this.signup_error_data = response.body[0]

                           this.signup_error=true
 
                        });
                    },

           handleSignin:function(){
             const postData=
                      {
                       'grant_type':'password',
                       'client_id':clientId,
                       'client_secret':clientSecret,
                       'username':this.login.email,
                       'password':this.login.password,
                       'scope':''
                      }

                      const authUser={}
                     

this.$http.post(loginRoute, postData).then((response)=>{ 
                authUser.access_token=response.data.access_token;

                authUser.refresh_token=response.data.refresh_token;

                window.localStorage.setItem('authUser',JSON.stringify(authUser));
            

this.$http.get(userRoute,{headers: getHeader()})

         .then((response)=>{ 


          authUser.userobject=response.body.user

       
          
   window.localStorage.setItem('authUser',JSON.stringify(authUser));
   

          
      //CHECK USER CATEGORIES
       const pData={ 
                    'grant_type':'password',
                    'client_id':clientId,
                    'client_secret':clientSecret,
                    'userid':response.body.user.id,
                    'scope':''
                  }

this.$http.post(userCategories,pData).then((response) => {
 
     window.localStorage.setItem('userCategories',JSON.stringify(response.body.data));
     
     this.$store.dispatch('setUserCategories',response.body.data);
    

  }, (response) => {
      console.log("something went wrong")
  });

 

     this.$store.dispatch('setUserObject',authUser)
     this.$router.push({name:'main'})
             })
          
        }, (response) => {

                           console.log(response)

                           this.signin_error_data = response.body

                           this.signin_error=true
 
                        })
      }

     }
    }
</script>
<template>

<div class="intro">
       <div class="container">
         <div class="col-md-8 welcome">
         <div class="col-md-4 explaination"></div>
           <div class="col-md-4 demo">
           <!--<img src="../public/images/iphone6.png" class="demo-img">-->

            

           </div>
           </div>



         <div class="col-md-4 user-auth">

         <transition name="fade">
           <div id="signup" v-show="signupShow" v-if="signupShow">
              <div class="signup">
                 <button class="btn btn-primary btn-block">
                      <i class="fa fa-facebook-square fa-lg"></i>  Log In with Facebook
                 </button> 
                 
                 <h4><span>OR</span></h4>

                 <div class="signup-div">
                           
                     <div class="signup-errors" v-if="signup_error">
                        <div class="alert alert-danger"> 
                         
                         <div class="col-md-1 su-errors-close pull-right">
                            <i class="fa fa-close" v-on:click="signup_error=false"></i>
                          </div>

                          <ol>
                           <!--error list-->

                             <li v-for="x in signup_error_data">{{x}}</li>


                          </ol>
                      </div>
                     </div>
                   
                <form v-on:submit.prevent="handleSignup">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" 
                        v-model="signup.first_name"
                      >
                    </div>
                    
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name"
                          v-model="signup.last_name"
                      >
                     </div>
                              <div class="form-group">
                              	
          		         

                      <input type="text" class="form-control" placeholder="Email" id="email" name="email"
                          v-model="signup.email"
                      >

                              </div>
          		           
                             <div class="form-group">
          		          

                      <input type="password" class="form-control" placeholder="Password" id="password" name="password"
   v-model="signup.password"
                      >

                             	
                             </div>
                              <div class="form-group">
                      <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation"

                         v-model="signup.password_confirmation">

                      </div>

          		      
          		        <input type="submit" class=" btn btn-primary btn-block" value="Sign up">


                       </form>
                 
                      <p>By signing up, you agree to our<br> <b> Terms & Privacy Policy.</b></p>
                 </div>
                 
               </div>
              <div class="signin">
                 <p>Have an account?  <a class="login_btn" v-on:click="showLogin">Log in</a> </p>
             </div>
         </div>

         </transition>

          
          <!--Login -->


        <transition name="fade">  
          <div id="login" v-show="loginShow" v-if="loginShow">
          	
          
          <div class="signup">
          
          <button class="btn btn-primary btn-block">
              <i class="fa fa-facebook-square fa-lg"></i> Log In with Facebook
           </button>
           
           <h4><span>OR</span></h4>

            <div class="sign_or_log">
                <div class="signup-errors" v-if="signin_error">

                  <div class="alert alert-danger"> 
                         
                         <div class="col-md-1 su-errors-close pull-right">
                            <i class="fa fa-close" v-on:click="signin_error=false"></i>
                          </div>

                          <ol>
                           <!--error list-->

                           <li v-for="x in signin_error_data">{{x}}</li>

                          </ol>
                      </div>
                    </div>

                  <div class="login">
              <form v-on:submit.prevent="handleSignin">
                    <div class="form-group input-group">
                       
                       <span class="input-group-addon">
                          <i class="fa fa-user"></i>
                       </span>
                         
                   
              
                      <input type="email" id="user_email"name="email" placeholder="Email" class="form-control" v-model="login.email">

                     </div>
                     <div class="form-group input-group">
                         <span class="input-group-addon">
                               <i class="fa fa-lock"></i> 
                          </span> 
                          <input type="password" id="user_pwd"name="password" class="form-control" placeholder="Password" v-model="login.password">
                    </div>
                     <input type="submit" class="btn btn-primary btn-block " id="signin-submit">
               </form>
                     <p><a href="#">Forgot password?</a></p>
                  </div>


             </div>
            </div>
      <div class="signin"><p>Don't have an account? <a class="signup_btn" 
             v-on:click="showSignup">Sign up</a> </p></div>
           </div>
     </transition>      
          </div>




       </div>


</div>
</template>


<style>
.signup-errors{

 position: absolute;
 z-index: 99;

width:81%;


}
</style>