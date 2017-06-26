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

      'testing_pic':'',
      'testing_id':'',
      'chat_text':''
      
    }

   },
   mounted(){
      this.testing_id=this.userStore.authUser.userobject.id
      this.testing_pic=this.userStore.authUser.userobject.profile_picture
      console.log(this.testing_id)
      console.log('your pic is: ',this.testing_pic)


   },

   methods:{
     sendMessage:function(){
       console.log(this.chat_text)
   $('.chat_textarea').val('');
       
     }
 }
}

</script>

<template>
   <div>
		<div class="chatbox">
             <div class="chat_users navbar-fixed-top">
	             <div class="friend_image">
	             	<img :src="testing_pic" class="img-circle" height="30">
	             </div>
	             <div class="self_image">
	             	<img :src="testing_pic" class="img-circle" height="30">
	             </div>
             </div>


             <div class="chatlogs">
                 <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			  <div class="col-xs-12">
                     <div class="chat chat-friend">
                      afasdfa sdf asdf a sdf as df a sd fasdf
                      asdf asd fas dfas dfa sdf asdf as df asd f as df as dfa s dfa sdf a sdf as
                     
                     </div>
                </div>
                <div class="col-xs-12">
                     <div class="chat chat-self">
                       afasdfa sdf asdf 
                       
                     </div>
                </div>
			 
			 </div>
				 <form v-on:submit.prevent="sendMessage">
			 <div class="chat_form navbar-fixed-bottom">
				 	<textarea v-model="chat_text" class="chat_textarea"></textarea>
				    <button class="w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium">
	                <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			 </div>
			     </form>
        </div>
    </div>
</template>
<style>
    .chatbox{
     padding: 5px;
     background:#fff;
     padding-bottom: 70px;
	}
	.chatlogs{
		padding-bottom: 20px;
		overflow-x:hidden;
		overflow-y:scroll;
		margin-top: 35px;
     }
     .chat_users{
     	margin-top: 55px;
     }
     .chat_users .friend_image{
     	float:left;
     	margin-left:10px;
     }
     .chat_users .self_image{
     	float:right;
     	margin-right:10px;
     }

     .chat-friend{
     	position: relative;
     	float: left;
     	border-radius:0 10px 10px 10px;
     	background: #1adda4;
     }
     .chat-self{
     	position: relative;
     	float: right;
     	background: #1ddced;
     	border-radius:10px 0 10px 10px;

     }

     .chat{
     	color:#fff;
     	
     	padding: 8px;
     	margin-top:3px;

      }

       .chat-friend:after{
       	content: '';
		position: absolute;
		left: 0;
		top: 25%;
		width: 0;
		height: 0;
		border: 14px solid transparent;
		border-right-color: #1adda4;
		border-left: 0;
		border-top: 0;
		margin-top: -7px;
		margin-left: -14px;
       }

       .chat-self:after{
       	content: '';
		position: absolute;
		right: 0;
		top: 25%;
		width: 0;
		height: 0;
		border: 14px solid transparent;
		border-left-color: #1ddced;
		border-right: 0;
		border-top: 0;
		margin-top: -7px;
		margin-right: -14px;
       }

       .friend-image img{
       	border:15px solid #fff;
       }
       .self-image img{
       	border:15px solid #fff;
       }

	 .chat_form{
	  margin-bottom: 40px;
	 }


   .chat_form{
    display: flex;
   	align-items: flex-start;
   	margin-bottom: 40px;
    padding: 10px 10px;
   	width: 100%;
   	background-color: #fff;
   }

   .chat_form textarea{
   	background-color: #fbfbfb;
   	width: 95%;
   	height: 40px;
   	border-radius:3px;
   	resize: none;
   	font-size: 22px;
   	color:#333;

   	border-color: #ccc;
   }


   .chat_form textarea::-webkit-scrollbar{
   	width:5px;
   }
   
   .chat_form textarea::-webkit-scrollbar-thumb{
   	border-radius:5px;
   	background-color:rgba(0,0,0,.1);
   }

   .chat_form textarea:focus{
	background-color:#fff; 
   }

 
  
  .chat_form button{
  	background:#1ddced;
  	margin-left:10px;
  	font-size:12px;

   
   }

  .chat_form button:hover{
  	background: #13c8d9
  }


</style>