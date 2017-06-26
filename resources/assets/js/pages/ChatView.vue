<script>

import {mapState} from 'Vuex';
import {getPrivateRoom,sendChat} from '../config.js';

  

   import io from 'socket.io-client';

   const socket=io('http://192.168.10.10:8890');

  
export default{
    computed:{

...mapState({
        userStore: state => state.userStore,
        initDataStore: state => state.userStore
       })
 },

   data(){

    return {

      'testing_pic':'',
      'testing_id':'',
      'chat_text':'',

      'friend_name':'',
      'friend_pic':'',
      'friend_id':'',


      'my_name':'',
      'my_pic':'',
      'my_id':'',
      'room_id':'',
      'arrayIndex':0
      }

   },
   mounted(){
      
     this.friend_name=this.userStore.current_chat_view.first_name
     this.friend_pic=this.userStore.current_chat_view.profile_pic
     this.friend_id=this.userStore.current_chat_view.id

     this.my_id=this.userStore.authUser.userobject.id
     this.my_name=this.userStore.authUser.userobject.first_name
     this.my_pic=this.userStore.authUser.userobject.profile_picture
     this.getRoomData()
     
 },

   methods:{
     sendMessage:function(){

    var pData={
                'sender_id':this.my_id,
                'room_id':this.room_id,
                'chat':this.chat_text,
                'receiver_id':this.friend_id
              };


    
    
if(this.chat_text!='')
{
     var payload={
                   'chat':this.chat_text,
                   'sender_id':this.my_id
                 };

     this.$store.dispatch('appendMyMessage',payload);

     
    
     this.$http.post(sendChat,pData).then((response) => {
       
        $('.chat_textarea').val('');
 
   var n = $('.chatlogs').height();

             $('html, body').animate({scrollTop:n},'50');
         




       console.log(response)

       }, (response) => {
         $('.chat_textarea').val('');
        console.log("something went wrong")
       });

  


} else{
      
        $('.chat_textarea').val('');
      console.log(this.chat_text)

     

     }




   //send my message to the server
  
 
       
     },
     getRoomData(){

      var pData={
        'user_one_id':this.my_id,
        'user_two_id':this.friend_id
      }
     
this.$http.post(getPrivateRoom,pData).then((response) => {
 
     /*window.localStorage.setItem('userCategories',JSON.stringify(response.body.data));
     
     this.$store.dispatch('setUserCategories',response.body.data);*/

    console.log(response.body);
    console.log('running!')
    var data=response.body;

  this.room_id=data.room_id
  var payload={
    'room_id':data.room_id,
    'user_one_id':data.user_one,
    'user_two_id':data.user_two,
    'chats':data.chats
   }

   this.$store.dispatch('setRooms',payload);

  }, (response) => {
      console.log("something went wrong")
  });


     },

   }
}

</script>

<template>
   <div>
		<div class="chatbox">
             <div class="chat_users navbar-fixed-top">
	             <div class="friend_image">
               <table>
                 <tr>
                   <td>
                      <img :src="friend_pic" class="img-circle" height="30">
                   </td>
                   <th>
                      <p class="chat_users_names">{{friend_name}}</p>
                   </th>
                 </tr>
               </table>
	             </div>
	             <div class="self_image">
               <table>
                 <tr>
                   <th>
                      <p class="chat_users_names">{{my_name}}</p>
                   </th>
                   <td>
                      <img :src="my_pic" class="img-circle" height="30">
                   </td>
                 </tr>
               </table>
	             </div>
             </div>

             <div class="chatlogs">
                 <div class="col-xs-12" v-for="chat in userStore.current_chats[0]">
                     <div :class="{chat:true, chat_friend:my_id!=chat.sender_id, chat_self:my_id==chat.sender_id}">
                         
                      {{chat.chat}}
                        
                     </div>
                   
                </div>
			      </div>
				 <form v-on:submit.prevent="sendMessage">
			 <div class="chat_form navbar-fixed-bottom">
				 	<textarea v-model="chat_text" class="chat_textarea"></textarea>
				    <button class="w3-btn-floating w3-teal w3-white w3-border w3-border-teal w3-medium" type="submit">
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
		margin-top: 45px;
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

     .chat_friend{
     	position: relative;
     	float: left;
     	border-radius:5px 10px 10px 10px;
     	background: #1adda4;
     }
     .chat_self{
     	position: relative;
     	float: right;
     	background: #1ddced;
     	border-radius:10px 5px 10px 10px;

     }

     .chat{
     	color:#fff;
     	
     	padding: 8px;
     	margin-top:3px;

      }

       .chat_friend:after{
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

       .chat_self:after{
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
  .chat_users_names{
    
    padding-left: 8px;
    padding-right: 8px;
    padding-top:3px;
    padding-bottom:3px;

    background: #fff;

    border-radius: 15px;
    line-height: 20px;
    margin-top: 15px;
    font-size: 10pt;

  }


</style>