<script>
	
import {mapState} from 'Vuex';

import {getMessages,sendTest,getHeader,userRoute,postsRoute} from '../config.js';

import {clientId, clientSecret } from '../.env.js';

import io from 'socket.io-client';

const socket=io('http://192.168.10.10:8890');

export default {
	computed:{

         ...mapState({
        userStore: state => state.userStore
       })

      },
      data:function(){
  		return {
  			chat:'',
  			receiver_id:1,
  			messages:''
  		}
  	},
      mounted() {
     //Read Messages From API
        this.getMessages()
           
         //Connect to the socket
         /* socket.on('message', function (data) {

                console.log(data)
          });  */


           socket.on('message', function (data) {

                console.log('Quiz ',data)



          });

      },
   methods:{
      testSocket:function(){
           const postData={
              'grant_type':'password',
              'client_id':clientId,
              'client_secret':clientSecret,
                       'sender_id':this.userStore.authUser.userobject.id,
                       'receiver_id':this.receiver_id,
                       'chat':this.chat,
                       'scope':''
                       }
                 
                 this.$http.post(sendTest,postData).then((response) => {
                     console.log(response)
                     this.chat=""
                }, (response) => {
            console.log(response)
          });
         },
     getMessages(){

          this.$http.get(getMessages+this.userStore.authUser.userobject.id+'/'+1).then((response) => {
             
             this.messages=response.data.chats
          
          }, (response) => {
            
            console.log('Things went wrong')
          
          });

         }
     }
  }
</script>
<template>
  <div class="container">
	 <h1>Socket Test</h1>
	
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    
                    <div class="panel-heading">Send message</div>
                  
                  <ul>
                    <li v-for="message in messages">
                      {{message.chat}}
                    </li>
                  </ul>
                 
                   <hr>
                    <form v-on:submit.prevent="testSocket">
                       <input  v-model="chat" type="text" placeholder="Message">
                    <input class="btn btn-primary" type="submit" value="send">
                    </form>
                </div>
            </div>
        </div>
 </div>
</template>