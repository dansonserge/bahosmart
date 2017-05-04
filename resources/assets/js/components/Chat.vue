<script>

import {mapState} from 'Vuex'
  

   import io from 'socket.io-client';

   const socket=io('http://192.168.10.10:8890');

  
export default{
    computed:{
      
   },

   data(){

    return {
      
    }

   },

   mounted(){
    
   },

   methods:{
   
   }
}

</script>

<template>
  
          <table class="table table-hover">
          <tr>
            <td class="col-xs-1 one_chat_item" data-userid="2">
            
            <img src="images/default-profile-male.gif" class="img-circle" height="50" width="50">
              
            </td>
           
            <td class="col-xs-11 one_chat" data-userid="2">
      
        
            <b></b><br>

            <p>Are you there so that we talk about the business?...</p>
              
     
           </td>
         
            
          </tr>
          <tr>
            <td class="col-xs-1 one_chat_item" data-userid="4">
             
              
            
            </td>
            <td class="col-xs-11 one_chat" data-userid="4">
           
            <b>Yannick Pacifique</b><br>
          <p>Are you there so that we talk about the business?...</p>
              
              
           
            </td>
            
          </tr>
          <tr>
            <td class="col-xs-1 one_chat_item" data-userid="3">
            
            
            </td>
            <td class="col-xs-11 one_chat" data-userid="3">
           
            <b>Yannick Pacifique</b><br>
          <p>Are you there so that we talk about the business?...</p>
              
              
           
            </td>
            
          </tr>
          <tr>
            <td class="col-xs-1 one_chat_item" data-userid="3">
             
            
            </td>
            <td class="col-xs-11 one_chat">
           
            <b>Yannick Pacifique</b><br>
          <p>Are you there so that we talk about the business?...</p>
              
              
           
            </td>
            
          </tr>

        </table> 
</template>

<style>
</style>